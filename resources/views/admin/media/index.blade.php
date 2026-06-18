@php
    $baseUrl = env('IMG_FETCH_URL') . 'uploaded_files/';
@endphp

@extends('admin.layout.app')

@section('content')
<div style="padding: 30px; max-width: 1400px;">

    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; margin: 0;">Media Manager</h1>
            <p style="color: var(--muted); margin: 4px 0 0; font-size: 13px;">
                {{ count($mediaItems) }} files · {{ number_format(array_sum(array_column($mediaItems, 'size')) / 1048576, 1) }} MB total
            </p>
        </div>
        <div>
            <span style="font-size: 12px; color: var(--muted);">
                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#ff6b81;margin-right:4px;"></span> Unused
                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#67fcc6;margin-right:4px;margin-left:16px;"></span> In use
            </span>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div style="padding:12px 16px;background:rgba(103,252,198,0.12);border:1px solid rgba(103,252,198,0.25);border-radius:8px;color:var(--teal);margin-bottom:20px;font-size:13px;">
            <i class="fas fa-check-circle" style="margin-right:8px;"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="padding:12px 16px;background:rgba(255,107,129,0.12);border:1px solid rgba(255,107,129,0.25);border-radius:8px;color:var(--danger);margin-bottom:20px;font-size:13px;">
            <i class="fas fa-exclamation-triangle" style="margin-right:8px;"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Search / filter bar --}}
    <div style="margin-bottom:20px;display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
        <input type="text" id="mediaSearch" placeholder="Search by filename..." 
               style="flex:1;min-width:200px;padding:10px 14px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;">
        <select id="filterUsed" style="padding:10px 14px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;">
            <option value="all">All files</option>
            <option value="unused">Unused only</option>
            <option value="used">In use only</option>
        </select>
        <select id="filterType" style="padding:10px 14px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;">
            <option value="all">All types</option>
            <option value="image">Images</option>
            <option value="video">Videos</option>
            <option value="other">Other</option>
        </select>
        <span style="flex:1;"></span>
        <label style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);cursor:pointer;">
            <input type="checkbox" id="selectAll" style="accent-color:#67fcc6;width:16px;height:16px;cursor:pointer;">
            Select All
        </label>
        <button id="deleteSelectedBtn" disabled
                style="padding:8px 16px;background:rgba(255,107,129,0.12);border:1px solid rgba(255,107,129,0.3);border-radius:8px;color:var(--danger);font-size:12px;font-weight:600;cursor:pointer;opacity:0.4;transition:all 0.2s;display:flex;align-items:center;gap:6px;">
            <i class="fas fa-trash-alt"></i> Delete Selected (<span id="selectedCount">0</span>)
        </button>
    </div>

    {{-- Bulk delete form --}}
    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.media.delete-bulk') }}" style="display:none;">
        @csrf
        <input type="hidden" name="paths" id="bulkPaths" value="">
    </form>

    {{-- Files grid --}}
    <div id="mediaGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
        @forelse($mediaItems as $item)
            <div class="media-card" 
                 data-filename="{{ strtolower($item['filename']) }}"
                 data-used="{{ $item['used'] ? '1' : '0' }}"
                 data-type="{{ $item['is_image'] ? 'image' : ($item['is_video'] ? 'video' : 'other') }}"
                 data-path="{{ $item['path'] }}"
                 style="background:var(--card);border-radius:12px;overflow:hidden;border:1px solid var(--border);transition:transform 0.2s,box-shadow 0.2s;position:relative;">

                {{-- Checkbox --}}
                <div style="position:absolute;top:8px;left:8px;z-index:3;">
                    <input type="checkbox" class="media-checkbox" value="{{ $item['path'] }}"
                           style="accent-color:#67fcc6;width:18px;height:18px;cursor:pointer;"
                           {{ $item['used'] ? 'disabled title="File in use"' : '' }}>
                </div>

                {{-- Badge --}}
                <div style="position:absolute;top:8px;right:8px;z-index:2;display:flex;gap:4px;">
                    @if(!$item['used'])
                        <span style="background:#ff6b81;color:#fff;font-size:9px;font-weight:700;padding:3px 7px;border-radius:4px;letter-spacing:0.02em;">ORPHAN</span>
                    @else
                        <span style="background:#67fcc6;color:#000;font-size:9px;font-weight:700;padding:3px 7px;border-radius:4px;letter-spacing:0.02em;">IN USE</span>
                    @endif
                </div>

                {{-- Preview --}}
                <div style="height:140px;background:#0d0b1a;display:flex;align-items:center;justify-content:center;overflow:hidden;cursor:pointer;"
                     onclick="previewMedia('{{ $baseUrl . $item['path'] }}', '{{ $item['is_video'] ? 'video' : 'image' }}')">
                    @if($item['is_image'])
                        <img src="{{ $baseUrl . $item['path'] }}" 
                             style="max-width:100%;max-height:100%;object-fit:contain;"
                             loading="lazy"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div style="display:none;align-items:center;justify-content:center;width:100%;height:100%;color:var(--muted);font-size:28px;">
                            <i class="fas fa-file-image"></i>
                        </div>
                    @elseif($item['is_video'])
                        <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:var(--muted);font-size:36px;flex-direction:column;gap:6px;">
                            <i class="fas fa-video"></i>
                            <span style="font-size:10px;">{{ strtoupper($item['extension']) }}</span>
                        </div>
                    @else
                        <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:var(--muted);font-size:36px;flex-direction:column;gap:6px;">
                            <i class="fas fa-file"></i>
                            <span style="font-size:10px;">{{ strtoupper($item['extension']) }}</span>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div style="padding:12px;">
                    <div style="font-size:12px;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $item['filename'] }}">
                        {{ $item['filename'] }}
                    </div>
                    <div style="font-size:11px;color:var(--muted);margin-top:2px;">
                        {{ $item['size_formatted'] }}
                    </div>

                    {{-- Usage info --}}
                    @if(count($item['references']) > 0)
                        <div style="margin-top:6px;padding-top:6px;border-top:1px solid var(--border);">
                            @foreach(array_slice($item['references'], 0, 2) as $ref)
                                <div style="font-size:10px;color:var(--teal);margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $ref['page'] }} / {{ $ref['field_name'] }}">
                                    <i class="fas fa-link" style="margin-right:3px;font-size:8px;"></i>
                                    {{ $ref['page'] }} › {{ $ref['field_name'] }}
                                </div>
                            @endforeach
                            @if(count($item['references']) > 2)
                                <div style="font-size:10px;color:var(--muted);">+{{ count($item['references']) - 2 }} more</div>
                            @endif
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div style="margin-top:8px;display:flex;gap:6px;">
                        <a href="{{ $baseUrl . $item['path'] }}" target="_blank"
                           style="flex:1;text-align:center;padding:6px;background:rgba(255,255,255,0.06);border-radius:6px;color:var(--muted);font-size:11px;text-decoration:none;transition:background 0.2s;"
                           onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                            <i class="fas fa-external-link-alt" style="margin-right:4px;"></i> Open
                        </a>
                        @if(!$item['used'])
                            <form method="POST" action="{{ route('admin.media.delete') }}" style="flex:1;" 
                                  onsubmit="return confirm('Permanently delete {{ $item['filename'] }}?')">
                                @csrf
                                <input type="hidden" name="path" value="{{ $item['path'] }}">
                                <button type="submit"
                                        style="width:100%;text-align:center;padding:6px;background:rgba(255,107,129,0.12);border:none;border-radius:6px;color:var(--danger);font-size:11px;cursor:pointer;transition:background 0.2s;"
                                        onmouseover="this.style.background='rgba(255,107,129,0.25)'" onmouseout="this.style.background='rgba(255,107,129,0.12)'">
                                    <i class="fas fa-trash-alt" style="margin-right:4px;"></i> Delete
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.media.delete-force') }}" style="flex:1;"
                                  onsubmit="return confirm('⚠️ This file is IN USE. Delete anyway? This may break frontend images.')">
                                @csrf
                                <input type="hidden" name="path" value="{{ $item['path'] }}">
                                <button type="submit"
                                        style="width:100%;text-align:center;padding:6px;background:rgba(255,107,129,0.08);border:1px dashed rgba(255,107,129,0.3);border-radius:6px;color:var(--danger);font-size:11px;cursor:pointer;transition:background 0.2s;"
                                        onmouseover="this.style.background='rgba(255,107,129,0.18)'" onmouseout="this.style.background='rgba(255,107,129,0.08)'">
                                    <i class="fas fa-exclamation-triangle" style="margin-right:4px;"></i> Force Del
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:var(--muted);">
                <i class="fas fa-folder-open" style="font-size:40px;margin-bottom:16px;display:block;"></i>
                <div style="font-size:16px;font-weight:600;">No uploaded files</div>
                <div style="font-size:13px;margin-top:4px;">Upload images/videos from any page editor — they'll appear here.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- Preview modal --}}
<div id="previewModal" 
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.85);z-index:9999;align-items:center;justify-content:center;cursor:pointer;"
     onclick="closePreview()">
    <div style="max-width:90vw;max-height:90vh;cursor:default;" onclick="event.stopPropagation()">
        <div style="text-align:right;margin-bottom:8px;">
            <button onclick="closePreview()" style="background:none;border:none;color:#fff;font-size:24px;cursor:pointer;"><i class="fas fa-times"></i></button>
        </div>
        <div id="previewContainer" style="display:flex;align-items:center;justify-content:center;min-width:300px;min-height:200px;"></div>
    </div>
</div>

<script>
function previewMedia(src, type) {
    var container = document.getElementById('previewContainer');
    container.innerHTML = '';
    if (type === 'video') {
        container.innerHTML = '<video src="' + src + '" controls autoplay style="max-width:100%;max-height:80vh;border-radius:8px;"></video>';
    } else {
        container.innerHTML = '<img src="' + src + '" style="max-width:100%;max-height:80vh;border-radius:8px;object-fit:contain;">';
    }
    document.getElementById('previewModal').style.display = 'flex';
}
function closePreview() {
    document.getElementById('previewModal').style.display = 'none';
    document.getElementById('previewContainer').innerHTML = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePreview();
});

// Live search + filter
(function() {
    var search = document.getElementById('mediaSearch');
    var filterUsed = document.getElementById('filterUsed');
    var filterType = document.getElementById('filterType');
    var cards = document.querySelectorAll('.media-card');

    function applyFilters() {
        var q = search.value.toLowerCase();
        var used = filterUsed.value;
        var type = filterType.value;
        cards.forEach(function(card) {
            var match = true;
            if (q && card.dataset.filename.indexOf(q) === -1) match = false;
            if (used === 'used' && card.dataset.used === '0') match = false;
            if (used === 'unused' && card.dataset.used === '1') match = false;
            if (type !== 'all' && card.dataset.type !== type) match = false;
            card.style.display = match ? '' : 'none';
        });
        updateSelectAllState();
    }

    search.addEventListener('input', applyFilters);
    filterUsed.addEventListener('change', applyFilters);
    filterType.addEventListener('change', applyFilters);
})();

// Multi-select delete
(function() {
    var selectAll = document.getElementById('selectAll');
    var deleteBtn = document.getElementById('deleteSelectedBtn');
    var selectedCount = document.getElementById('selectedCount');
    var bulkForm = document.getElementById('bulkDeleteForm');
    var bulkPaths = document.getElementById('bulkPaths');

    function getSelected() {
        var checked = [];
        document.querySelectorAll('.media-checkbox:checked:not([disabled])').forEach(function(cb) {
            checked.push(cb.value);
        });
        return checked;
    }

    function updateUI() {
        var selected = getSelected();
        var count = selected.length;
        selectedCount.textContent = count;
        deleteBtn.disabled = count === 0;
        deleteBtn.style.opacity = count === 0 ? '0.4' : '1';

        var allCheckboxes = document.querySelectorAll('.media-checkbox:not([disabled])');
        var allChecked = allCheckboxes.length > 0;
        allCheckboxes.forEach(function(cb) {
            if (!cb.checked) allChecked = false;
        });
        selectAll.checked = allChecked;
    }

    function updateSelectAllState() {
        var visibleCheckboxes = [];
        document.querySelectorAll('.media-card').forEach(function(card) {
            if (card.style.display !== 'none') {
                var cb = card.querySelector('.media-checkbox');
                if (cb && !cb.disabled) visibleCheckboxes.push(cb);
            }
        });
        var allVisibleChecked = visibleCheckboxes.length > 0;
        visibleCheckboxes.forEach(function(cb) {
            if (!cb.checked) allVisibleChecked = false;
        });
        selectAll.checked = allVisibleChecked;
    }

    // Select All
    selectAll.addEventListener('change', function() {
        document.querySelectorAll('.media-card').forEach(function(card) {
            if (card.style.display !== 'none') {
                var cb = card.querySelector('.media-checkbox');
                if (cb && !cb.disabled) {
                    cb.checked = selectAll.checked;
                }
            }
        });
        updateUI();
    });

    // Individual checkbox change
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('media-checkbox')) {
            updateUI();
        }
    });

    // Delete Selected
    deleteBtn.addEventListener('click', function() {
        var selected = getSelected();
        if (selected.length === 0) return;
        var msg = 'Permanently delete ' + selected.length + ' selected file(s)?';
        if (selected.length === 1) {
            msg = 'Permanently delete ' + selected[0].split('/').pop() + '?';
        }
        if (!confirm(msg)) return;
        bulkPaths.value = JSON.stringify(selected);
        bulkForm.submit();
    });
})();
</script>

<style>
.media-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
}
</style>
@endsection
