<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\ExtraImage;
use App\Models\Project;

class MediaController extends Controller
{
    public function index()
    {
        // Scan all uploaded files
        $uploadDir = public_path('uploaded_files');
        $files = $this->scanFiles($uploadDir);

        // Pre-load DB references for quick lookup
        $dbRefs = $this->loadDbReferences();

        $mediaItems = [];
        foreach ($files as $file) {
            $relativePath = $this->relativePath($file, $uploadDir);
            $filename = basename($file);
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $size = filesize($file);
            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'bmp']);
            $isVideo = in_array($ext, ['mp4', 'webm', 'mov', 'avi', 'mkv']);

            // Check DB references
            $references = $this->findReferences($dbRefs, $relativePath, $filename);

            $mediaItems[] = [
                'path' => $relativePath,
                'filename' => $filename,
                'extension' => $ext,
                'size' => $size,
                'size_formatted' => $this->formatSize($size),
                'is_image' => $isImage,
                'is_video' => $isVideo,
                'references' => $references,
                'used' => count($references) > 0,
                'modified' => filemtime($file),
            ];
        }

        // Sort: unused files first (likely orphaned)
        usort($mediaItems, function ($a, $b) {
            if ($a['used'] !== $b['used']) return $a['used'] - $b['used'];
            return strcmp($a['filename'], $b['filename']);
        });

        return view("admin.media.index", compact('mediaItems'));
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');
        if (!$path) {
            return back()->with('error', 'No file specified.');
        }

        // Security: prevent path traversal
        $path = str_replace(['..', './', '../'], '', $path);

        // Check if used in DB
        $dbRefs = $this->loadDbReferences();
        $references = $this->findReferences($dbRefs, $path, basename($path));
        if (count($references) > 0) {
            $pages = implode(', ', array_column($references, 'page'));
            return back()->with('error', "Cannot delete — file is used in: {$pages}. Remove DB references first.");
        }

        $fullPath = public_path('uploaded_files/' . $path);
        if (file_exists($fullPath)) {
            @unlink($fullPath);
            return back()->with('success', "Deleted: {$path}");
        }

        return back()->with('error', 'File not found.');
    }

    public function deleteForce(Request $request)
    {
        $path = $request->input('path');
        if (!$path) {
            return back()->with('error', 'No file specified.');
        }
        $path = str_replace(['..', './', '../'], '', $path);

        $fullPath = public_path('uploaded_files/' . $path);
        if (file_exists($fullPath)) {
            @unlink($fullPath);
            return back()->with('success', "Force deleted: {$path}");
        }

        return back()->with('error', 'File not found.');
    }

    public function deleteBulk(Request $request)
    {
        $paths = $request->input('paths', []);
        if (empty($paths) || !is_array($paths)) {
            return back()->with('error', 'No files selected.');
        }

        $deleted = 0;
        $errors = 0;
        $dbRefs = $this->loadDbReferences();

        foreach ($paths as $path) {
            $path = str_replace(['..', './', '../'], '', $path);
            if (empty($path)) continue;

            $references = $this->findReferences($dbRefs, $path, basename($path));
            if (count($references) > 0) {
                $errors++;
                continue;
            }

            $fullPath = public_path('uploaded_files/' . $path);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
                $deleted++;
            }
        }

        $msg = "Deleted {$deleted} file(s).";
        if ($errors > 0) {
            $msg .= " {$errors} file(s) skipped (in use).";
        }
        return back()->with('success', $msg);
    }

    // ─── Private helpers ───

    private function scanFiles($dir)
    {
        $result = [];
        if (!is_dir($dir)) return $result;

        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            $full = $dir . '/' . $item;
            if (is_dir($full)) {
                $result = array_merge($result, $this->scanFiles($full));
            } else {
                $result[] = $full;
            }
        }

        return $result;
    }

    private function relativePath($fullPath, $baseDir)
    {
        return ltrim(str_replace($baseDir, '', $fullPath), '/');
    }

    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return number_format($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return number_format($bytes / 1024, 0) . ' KB';
        return $bytes . ' B';
    }

    private function loadDbReferences()
    {
        $refs = [];

        // 1. All pages fields
        $pages = Page::all();
        foreach ($pages as $page) {
            $fields = json_decode($page->fields);
            if (!is_array($fields)) continue;
            foreach ($fields as $field) {
                if (isset($field->img) && !empty($field->img)) {
                    $refs[] = [
                        'img' => $field->img,
                        'page' => $page->page,
                        'section' => $page->section,
                        'field_name' => $field->name ?? 'N/A',
                        'table' => 'pages',
                    ];
                }
            }
        }

        // 2. Extra images
        $extraImages = ExtraImage::all();
        foreach ($extraImages as $ei) {
            if (!empty($ei->banner)) {
                $refs[] = [
                    'img' => $ei->banner,
                    'page' => $ei->page,
                    'section' => 'extra_images',
                    'field_name' => 'Banner Image',
                    'table' => 'extra_images',
                ];
            }
        }

        // 3. Projects
        $projects = Project::all();
        foreach ($projects as $proj) {
            if (!empty($proj->image)) {
                $refs[] = [
                    'img' => $proj->image,
                    'page' => 'Project: ' . ($proj->title ?? 'N/A'),
                    'section' => 'projects',
                    'field_name' => 'Project Image',
                    'table' => 'projects',
                ];
            }
        }

        return $refs;
    }

    private function findReferences($dbRefs, $relativePath, $filename)
    {
        $matches = [];
        foreach ($dbRefs as $ref) {
            // Match by exact img path or filename contained in img path
            if ($ref['img'] === $relativePath || strpos($ref['img'], $filename) !== false) {
                $matches[] = $ref;
            }
        }
        return $matches;
    }
}
