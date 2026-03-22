@extends('admin.layout.app')
@section('page-title', 'Dashboard')

@section('content')

<div style="margin-bottom: 28px;">
  <h1 style="font-family:'Manrope',sans-serif; font-size:24px; font-weight:800; color:var(--text); margin-bottom:4px;">
    Welcome back 👋
  </h1>
  <p style="color:var(--muted); font-size:14px;">Here's what's happening with your site today.</p>
</div>

<!-- STAT CARDS -->
<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:16px; margin-bottom:28px;">

  <div class="tsa-card" style="padding:20px; margin:0; display:flex; align-items:center; gap:16px;">
    <div style="width:48px;height:48px;border-radius:12px;background:rgba(223,248,17,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <i class="fas fa-file-lines" style="color:var(--lime);font-size:20px;"></i>
    </div>
    <div>
      <div style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Total Pages</div>
      <div style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:var(--text);line-height:1.1;">{{ $pageCount ?? '—' }}</div>
    </div>
  </div>

  <div class="tsa-card" style="padding:20px; margin:0; display:flex; align-items:center; gap:16px;">
    <div style="width:48px;height:48px;border-radius:12px;background:rgba(103,252,198,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <i class="fas fa-inbox" style="color:var(--teal);font-size:20px;"></i>
    </div>
    <div>
      <div style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Total Queries</div>
      <div style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:var(--text);line-height:1.1;">{{ $queryCount ?? '—' }}</div>
    </div>
  </div>

  <div class="tsa-card" style="padding:20px; margin:0; display:flex; align-items:center; gap:16px;">
    <div style="width:48px;height:48px;border-radius:12px;background:rgba(124,58,237,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <i class="fas fa-user-circle" style="color:#a78bfa;font-size:20px;"></i>
    </div>
    <div>
      <div style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Admin</div>
      <div style="font-family:'Manrope',sans-serif;font-size:16px;font-weight:700;color:var(--text);line-height:1.3;margin-top:4px;">{{ Auth::user()->name ?? 'Administrator' }}</div>
    </div>
  </div>

</div>

<!-- QUICK LINKS -->
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

  <div class="tsa-card" style="margin:0;">
    <div class="tsa-card-title">
      <span><i class="fas fa-bolt" style="color:var(--lime);margin-right:8px;"></i>Quick Actions</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:10px;">
      <a href="{{ route('admin.page') }}" class="btn btn-teal" style="justify-content:flex-start;">
        <i class="fas fa-file-lines"></i> Manage Pages
      </a>
      <a href="{{ route('admin.query') }}" class="btn btn-ghost" style="justify-content:flex-start;">
        <i class="fas fa-inbox"></i> View Queries
      </a>
      <a href="{{ route('admin.profile') }}" class="btn btn-ghost" style="justify-content:flex-start;">
        <i class="fas fa-user-pen"></i> Edit Profile
      </a>
    </div>
  </div>

  <div class="tsa-card" style="margin:0;">
    <div class="tsa-card-title">
      <span><i class="fas fa-circle-info" style="color:var(--teal);margin-right:8px;"></i>System Info</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:12px;">
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);">
        <span style="color:var(--muted);font-size:13px;">Laravel Version</span>
        <span class="badge badge-lime">{{ app()->version() }}</span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);">
        <span style="color:var(--muted);font-size:13px;">PHP Version</span>
        <span class="badge badge-teal">{{ PHP_VERSION }}</span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
        <span style="color:var(--muted);font-size:13px;">Environment</span>
        <span class="badge badge-muted">{{ app()->environment() }}</span>
      </div>
    </div>
  </div>

</div>

@endsection