@extends('admin.layout.app')
@section('page-title', 'Add Author')

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
  <a href="{{ route('admin.authors.index') }}" class="btn btn-ghost" style="padding:8px 16px;">
    <i class="fas fa-arrow-left"></i> Back
  </a>
  <h2 style="margin:0;font-size:22px;">Add Author</h2>
</div>

<div class="tsa-card" style="max-width:800px;">
  <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data" id="authorForm">
    @csrf

    <div class="form-group">
      <label>Name <span style="color:var(--red);">*</span></label>
      <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Anushka Kukreja" required />
    </div>

    <div class="form-group">
      <label>Bio</label>
      <textarea class="form-control" name="bio" rows="4" placeholder="Short author biography...">{{ old('bio') }}</textarea>
    </div>

    <div class="form-group">
      <label>Profile Image</label>
      <div id="cropUploader">
        {{-- Drop zone / click to select --}}
        <div id="dropZone" style="border:2px dashed var(--border);border-radius:12px;padding:32px;text-align:center;cursor:pointer;transition:border-color 0.2s;background:rgba(255,255,255,0.02);"
             onmouseover="this.style.borderColor='var(--lime)'" onmouseout="this.style.borderColor='var(--border)'">
          <div style="font-size:48px;color:var(--muted);margin-bottom:8px;">
            <i class="fas fa-cloud-upload-alt"></i>
          </div>
          <div style="color:var(--text);font-weight:500;margin-bottom:4px;">
            Click to select an image
          </div>
          <div style="font-size:12px;color:var(--muted);">
            JPEG, PNG, GIF, WebP. Max 2MB. Will be cropped to a square.
          </div>
        </div>

        {{-- Hidden file input --}}
        <input type="file" id="cropInput" name="profile_image" accept="image/*" style="display:none;" />

        {{-- Preview area (hidden initially) --}}
        <div id="cropPreview" style="display:none;margin-top:16px;">
          <div style="position:relative;display:inline-block;border-radius:12px;overflow:hidden;border:2px solid var(--border);">
            <img id="cropPreviewImg" src="" alt="Preview" style="max-width:280px;display:block;" />
            <div id="cropPreviewOverlay"
                 style="position:absolute;inset:0;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;gap:10px;opacity:0;transition:opacity 0.2s;cursor:pointer;"
                 onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
              <button type="button" class="btn btn-sm btn-light" onclick="openCropper()">
                <i class="fas fa-crop-alt"></i> Crop
              </button>
              <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()">
                <i class="fas fa-trash"></i> Remove
              </button>
            </div>
          </div>
          <p style="font-size:11px;color:var(--muted);margin-top:6px;">
            <i class="fas fa-check-circle" style="color:var(--lime);"></i> Image selected. Hover to crop again or remove.
          </p>
        </div>

        {{-- Hidden input for cropped base64 --}}
        <input type="hidden" name="profile_image_cropped" id="cropData" value="" />
      </div>
    </div>

    <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--border);">
      <h4 style="margin:0 0 12px;font-size:14px;color:var(--text);">Social Links</h4>
      <p style="font-size:12px;color:var(--muted);margin:0 0 16px;">Only filled-in links will show on the author box.</p>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-group">
          <label><i class="fab fa-facebook" style="color:#1877F2;margin-right:6px;"></i>Facebook</label>
          <input class="form-control" type="url" name="facebook" value="{{ old('facebook') }}" placeholder="https://facebook.com/..." />
        </div>
        <div class="form-group">
          <label><i class="fab fa-instagram" style="color:#E4405F;margin-right:6px;"></i>Instagram</label>
          <input class="form-control" type="url" name="instagram" value="{{ old('instagram') }}" placeholder="https://instagram.com/..." />
        </div>
        <div class="form-group">
          <label><i class="fab fa-linkedin" style="color:#0A66C2;margin-right:6px;"></i>LinkedIn</label>
          <input class="form-control" type="url" name="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/..." />
        </div>
        <div class="form-group">
          <label><i class="fab fa-x-twitter" style="color:#1DA1F2;margin-right:6px;"></i>Twitter / X</label>
          <input class="form-control" type="url" name="twitter" value="{{ old('twitter') }}" placeholder="https://twitter.com/..." />
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;margin-top:24px;">
      <i class="fas fa-save"></i> Create Author
    </button>
  </form>
</div>

{{-- Crop Modal --}}
<div id="cropModal" style="display:none;position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;flex-direction:column;padding:20px;">
  <div style="background:#1a1a2e;border-radius:16px;overflow:hidden;max-width:90vw;max-height:90vh;display:flex;flex-direction:column;box-shadow:0 20px 60px rgba(0,0,0,0.5);">
    <div style="padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.08);">
      <h3 style="margin:0;font-size:16px;font-weight:600;color:#fff;">
        <i class="fas fa-crop-alt" style="margin-right:8px;color:var(--lime);"></i>Crop Profile Image
      </h3>
      <button type="button" onclick="closeCropper()" style="background:none;border:none;color:rgba(255,255,255,0.4);font-size:20px;cursor:pointer;padding:4px 8px;">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div style="flex:1;overflow:hidden;min-height:300px;background:#0d0d1a;">
      <img id="cropModalImage" src="" alt="Crop" style="max-width:100%;display:block;" />
    </div>
    <div style="padding:14px 20px;display:flex;align-items:center;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.08);flex-wrap:wrap;gap:8px;">
      <div style="display:flex;gap:8px;align-items:center;">
        <button type="button" onclick="cropper.zoom(0.1)" class="btn btn-sm btn-ghost" style="padding:6px 10px;" title="Zoom In">
          <i class="fas fa-search-plus"></i>
        </button>
        <button type="button" onclick="cropper.zoom(-0.1)" class="btn btn-sm btn-ghost" style="padding:6px 10px;" title="Zoom Out">
          <i class="fas fa-search-minus"></i>
        </button>
        <button type="button" onclick="cropper.reset()" class="btn btn-sm btn-ghost" style="padding:6px 10px;" title="Reset">
          <i class="fas fa-undo"></i>
        </button>
      </div>
      <button type="button" id="cropApplyBtn" class="btn btn-lime" style="padding:8px 28px;" onclick="applyCrop()">
        <i class="fas fa-check"></i> Apply Crop
      </button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
// ==================== Cropper.js ====================
let cropper = null;
let cropperFile = null;

// Click on drop zone → trigger file input
document.getElementById('dropZone').addEventListener('click', function() {
  document.getElementById('cropInput').click();
});

// File selected → open cropper
document.getElementById('cropInput').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (!file) return;
  if (file.size > 2 * 1024 * 1024) {
    alert('Image is too large. Maximum size is 2MB.');
    this.value = '';
    return;
  }
  cropperFile = file;
  const reader = new FileReader();
  reader.onload = function(ev) {
    document.getElementById('cropModalImage').src = ev.target.result;
    document.getElementById('cropModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    if (cropper) cropper.destroy();
    setTimeout(function() {
      cropper = new Cropper(document.getElementById('cropModalImage'), {
        aspectRatio: 1,
        viewMode: 1,
        dragMode: 'move',
        cropBoxResizable: true,
        cropBoxMovable: true,
        responsive: true,
        minCropBoxWidth: 100,
        minCropBoxHeight: 100,
      });
    }, 100);
  };
  reader.readAsDataURL(file);
});

function openCropper() {
  // Re-open with the existing cropped data (if available)
  const src = document.getElementById('cropPreviewImg').src;
  if (src && src !== '#') {
    document.getElementById('cropModalImage').src = src;
    document.getElementById('cropModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    if (cropper) cropper.destroy();
    setTimeout(function() {
      cropper = new Cropper(document.getElementById('cropModalImage'), {
        aspectRatio: 1,
        viewMode: 1,
        dragMode: 'move',
        cropBoxResizable: true,
        cropBoxMovable: true,
        responsive: true,
        minCropBoxWidth: 100,
        minCropBoxHeight: 100,
      });
    }, 100);
  }
}

function closeCropper() {
  if (cropper) { cropper.destroy(); cropper = null; }
  document.getElementById('cropModal').style.display = 'none';
  document.body.style.overflow = '';
  document.getElementById('cropInput').value = '';
}

function applyCrop() {
  if (!cropper) return;
  const canvas = cropper.getCroppedCanvas({
    width: 400,
    height: 400,
    imageSmoothingEnabled: true,
    imageSmoothingQuality: 'high',
  });
  const dataUrl = canvas.toDataURL('image/webp', 0.85);
  // Show preview
  document.getElementById('cropPreviewImg').src = dataUrl;
  document.getElementById('cropPreview').style.display = 'block';
  document.getElementById('dropZone').style.display = 'none';
  // Store in hidden input
  document.getElementById('cropData').value = dataUrl;
  closeCropper();
}

function removeImage() {
  document.getElementById('cropPreview').style.display = 'none';
  document.getElementById('dropZone').style.display = 'block';
  document.getElementById('cropData').value = '';
  document.getElementById('cropInput').value = '';
  document.getElementById('cropPreviewImg').src = '';
  if (cropper) { cropper.destroy(); cropper = null; }
  cropperFile = null;
}

// On form submit: if cropped data exists, clear file input to avoid dual upload
document.getElementById('authorForm').addEventListener('submit', function(e) {
  const cropped = document.getElementById('cropData').value;
  if (cropped) {
    // Clear file input so server uses cropped data
    document.getElementById('cropInput').disabled = true;
  }
});
</script>
@endsection
