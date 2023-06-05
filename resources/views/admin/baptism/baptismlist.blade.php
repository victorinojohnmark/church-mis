@extends('layouts.admin')

@section('title', 'Baptism')

@section('content')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="baptism-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Baptismal Date</th>
            <th>Birth Date</th>
            <th>Submitted At</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse($baptisms as $baptism)
            <tr>
                <td>
                    {{ $baptism->name }}
                    @if ($baptism->is_accepted)
                        <span class="badge bg-success">Accepted</span>
                    @elseif ($baptism->is_rejected)
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                <td>{{ $baptism->date }}</td>
                <td>{{ $baptism->birth_date }}</td>
                <td>{{ $baptism->created_at }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#baptismModal{{ $baptism->id }}">View</button>
                    @include('admin.baptism.baptismmodal')

                    @if (!$baptism->is_accepted && !$baptism->is_rejected)
                        <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#baptismAcceptModal{{ $baptism->id }}">Accept</button>
                        @include('admin.baptism.baptismacceptmodal')
                    
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#baptismRejectModal{{ $baptism->id }}">Reject</button>
                        @include('admin.baptism.baptismrejectmodal')
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
            $('#baptism-table').DataTable();

        });
    </script>
@endpush
