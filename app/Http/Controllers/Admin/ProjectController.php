<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tags'  => 'nullable|string',
            'link'  => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $imagePath = $filename;
        }

        Project::create([
            'title'      => $request->title,
            'tags'       => $request->tags,
            'image'      => $imagePath,
            'link'       => $request->link ?? '#',
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'tags'  => 'nullable|string',
        ]);

        $imagePath = $project->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image && file_exists(public_path('images/' . $project->image))) {
                unlink(public_path('images/' . $project->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $imagePath = $filename;
        }

        $project->update([
            'title'      => $request->title,
            'tags'       => $request->tags,
            'image'      => $imagePath,
            'link'       => $request->link ?? '#',
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->image && file_exists(public_path('images/' . $project->image))) {
            unlink(public_path('images/' . $project->image));
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }
}