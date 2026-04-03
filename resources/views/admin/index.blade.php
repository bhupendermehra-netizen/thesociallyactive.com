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
<div class="tsa-card" style="padding:20px; margin:0; display:flex; align-items:center; gap:16px;">
  <div style="width:48px;height:48px;border-radius:12px;background:rgba(255,107,129,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
    <i class="fas fa-newspaper" style="color:#ff6b81;font-size:20px;"></i>
  </div>
  <div>
    <div style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Blog Posts</div>
    <div style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:var(--text);line-height:1.1;">
      {{ \App\Models\Blog::where('is_published', true)->count() }}
    </div>
  </div>
</div>
</div>
<!-- New thisgns  -->


{{-- 
  Admin Dashboard mein GA4 Embedded Report widget
  resources/views/admin/index.blade.php mein
  stat cards ke NEECHE add karo
--}}

{{-- GA4 Embedded Report Section --}}
<div class="tsa-card" style="margin-top:24px;">
  <div class="tsa-card-title">
    <span>
      <i class="fas fa-chart-line" style="color:var(--lime);margin-right:8px;"></i>
      Website Traffic
      <span class="badge badge-muted" style="margin-left:8px;font-size:10px;">Google Analytics</span>
    </span>
    <a href="https://analytics.google.com" target="_blank" class="btn btn-ghost" style="font-size:12px;">
      <i class="fas fa-external-link-alt"></i> Open Analytics
    </a>
  </div>

  {{-- GA Embedded Report iframe --}}
  <div style="position:relative;width:100%;border-radius:12px;overflow:hidden;background:var(--hover);">
    <iframe
      src="https://lookerstudio.google.com/embed/reporting/create?c.reportId=&ds.connector=GOOGLE_ANALYTICS_4&ds.propertyId=14284518222"
      style="display:none;"
      id="ga-iframe">
    </iframe>

    {{-- Custom GA Stats Display --}}
    <div id="ga-stats" style="padding:24px;">

      {{-- Stats Row --}}
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:16px;margin-bottom:24px;">
        
        <div style="background:var(--card);border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">Today's Visitors</div>
          <div id="ga-today" style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:var(--lime);">—</div>
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Real-time</div>
        </div>

        <div style="background:var(--card);border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">This Month</div>
          <div id="ga-month" style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:var(--teal);">—</div>
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Sessions</div>
        </div>

        <div style="background:var(--card);border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">Bounce Rate</div>
          <div id="ga-bounce" style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:#a78bfa;">—</div>
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Average</div>
        </div>

        <div style="background:var(--card);border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">Page Views</div>
          <div id="ga-pageviews" style="font-family:'Manrope',sans-serif;font-size:28px;font-weight:800;color:var(--lime);">—</div>
          <div style="font-size:11px;color:var(--muted);margin-top:4px;">Last 30 days</div>
        </div>

      </div>

      {{-- Info message --}}
      <div style="background:rgba(223,248,17,0.06);border:1px solid rgba(223,248,17,0.15);border-radius:10px;padding:16px;display:flex;align-items:flex-start;gap:12px;">
        <i class="fas fa-circle-info" style="color:var(--lime);margin-top:2px;flex-shrink:0;"></i>
        <div>
          <div style="font-size:13px;font-weight:600;color:var(--text);margin-bottom:4px;">GA4 API Setup Required</div>
          <div style="font-size:12px;color:var(--muted);line-height:1.6;">
            Live data dekhne ke liye GA4 API credentials configure karni hongi.
            Abhi <a href="https://analytics.google.com/analytics/web/#/p14284518222/reports/intelligenthome" 
            target="_blank" style="color:var(--lime);">Google Analytics Dashboard</a> pe seedha dekh sakte ho.
            <br><br>
            <strong style="color:var(--text);">Property ID:</strong> <code style="background:var(--hover);padding:2px 8px;border-radius:4px;font-size:11px;">14284518222</code> &nbsp;
            <strong style="color:var(--text);">Measurement ID:</strong> <code style="background:var(--hover);padding:2px 8px;border-radius:4px;font-size:11px;">G-J8FS8NYVR4</code>
          </div>
          <div style="margin-top:12px;display:flex;gap:8px;">
            <a href="https://analytics.google.com/analytics/web/#/p14284518222/reports/intelligenthome" 
               target="_blank" class="btn btn-lime" style="padding:8px 16px;font-size:12px;">
              <i class="fas fa-chart-bar"></i> View Full Report
            </a>
            <a href="https://analytics.google.com/analytics/web/#/p14284518222/reports/realtimeoverview" 
               target="_blank" class="btn btn-teal" style="padding:8px 16px;font-size:12px;">
              <i class="fas fa-circle" style="color:#ff4040;font-size:8px;"></i> Real-time
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
// Fetch and display analytics data
async function loadAnalyticsData() {
  try {
    const response = await fetch('{{ route("admin.analytics.data") }}');
    const data = await response.json();
    
    if (data.error) {
      console.error('Analytics Error:', data.message);
      return;
    }
    
    // Update the dashboard with real data
    document.getElementById('ga-today').textContent = data.today || '—';
    document.getElementById('ga-month').textContent = data.month || '—';
    document.getElementById('ga-bounce').textContent = data.bounce_rate || '—';
    document.getElementById('ga-pageviews').textContent = data.pageviews || '—';
    
    // Update last updated time
    const lastUpdated = document.createElement('div');
    lastUpdated.style.cssText = 'font-size:10px;color:var(--muted);margin-top:8px;';
    lastUpdated.textContent = `Last updated: ${data.last_updated || 'Never'}`;
    
    const existingLastUpdated = document.querySelector('#ga-stats .last-updated');
    if (existingLastUpdated) {
      existingLastUpdated.replaceWith(lastUpdated);
    } else {
      document.getElementById('ga-stats').appendChild(lastUpdated);
    }
    
  } catch (error) {
    console.error('Failed to load analytics data:', error);
  }
}

// Load analytics data when page loads
document.addEventListener('DOMContentLoaded', loadAnalyticsData);

// Refresh data every 5 minutes
setInterval(loadAnalyticsData, 5 * 60 * 1000);
</script>
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