@extends('layouts.admin')

@section('title', 'Blessing')

@section('content')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="blessing-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Address</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($blessings as $blessing)
        <tr>
            <td>
                {{ $blessing->name }}
                @if ($blessing->is_accepted)
                    <span class="badge bg-success">Accepted</span>
                @elseif ($blessing->is_rejected)
                    <span class="badge bg-danger">Rejected</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </td>
            <td>{{ $blessing->blessing_type }}</td>
            <td>{{ $blessing->date }}</td>
            <td>{{ $blessing->time }}</td>
            <td>{{ $blessing->address }}</td>

            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#blessingModal{{ $blessing->id }}">View</button>
                @include('admin.blessing.blessingmodal')

                @if (!$blessing->is_accepted && !$blessing->is_rejected)
                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#blessingAcceptModal{{ $blessing->id }}">Accept</button>
                    @include('admin.blessing.blessingacceptmodal')
                
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#blessingRejectModal{{ $blessing->id }}">Reject</button>
                    @include('admin.blessing.blessingrejectmodal')
                @endif
            </td>
        </tr>
        @empty
            
        @endforelse
    </tbody>
</table>

@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#blessing-table').DataTable();

        });
    </script>
@endpush
