@extends('admin.layout.app')
@section('page-title', 'Queries')

@section('content')

<div class="tsa-card">
  <div class="tsa-card-title">
    <span>
      <i class="fas fa-inbox" style="color:var(--teal);margin-right:8px;"></i>
      All Queries
    </span>
    <span class="badge badge-teal">{{ count($query) }} Total</span>
  </div>

  <div style="overflow-x:auto;">
    <table class="tsa-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Service</th>
          <th>Message</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($query as $key => $data)
        <tr>
          <td class="muted">{{ $key + 1 }}</td>

          <td>
            <div style="display:flex;align-items:center;gap:10px;">
              <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--lime),var(--teal));display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#0d0b1a;flex-shrink:0;">
                {{ strtoupper(substr($data->name, 0, 1)) }}
              </div>
              <span style="font-weight:600;">{{ $data->name }}</span>
            </div>
          </td>

          <td class="muted">{{ $data->email }}</td>

          <td class="muted">{{ $data->phone }}</td>

          <td>
            <span class="badge badge-muted" style="text-transform:uppercase;font-size:10px;">
              {{ $data->service }}
            </span>
          </td>

          <td class="muted" style="max-width:200px;white-space:normal;line-height:1.5;">
            {{ Str::limit($data->message, 60) }}
          </td>

          <td class="muted" style="white-space:nowrap;">
            {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}
          </td>

          <td>
            <form action="{{ route('admin.query.delete', $data->id) }}" method="POST"
              onsubmit="return confirm('Delete this query from {{ $data->name }}?')">
              @csrf
              <button type="submit" class="btn btn-red">
                <i class="fas fa-trash"></i> Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach

        @if(count($query) === 0)
        <tr>
          <td colspan="8" style="text-align:center;padding:48px 20px;">
            <i class="fas fa-inbox" style="font-size:36px;color:var(--muted);opacity:0.4;display:block;margin-bottom:12px;"></i>
            <span style="color:var(--muted);font-size:14px;">No queries yet</span>
          </td>
        </tr>
        @endif

      </tbody>
    </table>
  </div>
</div>

@endsection