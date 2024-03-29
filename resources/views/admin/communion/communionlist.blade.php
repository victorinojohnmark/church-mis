@extends('layouts.admin')

@section('title', 'First Communion')

@section('content')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="communion-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Submitted At</th>
            <th>Total Participant</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($communions as $communion)
        <tr>
            
            <td>
                {{ $communion->created_at->format('Y-m-d h:i A') }}
                @if ($communion->is_accepted)
                    <span class="badge bg-success">Accepted</span>
                @elseif ($communion->is_rejected)
                    <span class="badge bg-danger">Rejected</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </td>
            <td>{{ $communion->details->count() }}</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#communionModal{{ $communion->id }}">View</button>
                @include('admin.communion.communionmodal')

                @if (!$communion->is_accepted && !$communion->is_rejected)
                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#communionAcceptModal{{ $communion->id }}">Accept</button>
                    @include('admin.communion.communionacceptmodal')
                
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#communionRejectModal{{ $communion->id }}">Reject</button>
                    @include('admin.communion.communionrejectmodal')
                @endif

                @if($communion->is_accepted)
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#communionModalDelete{{ $communion->id }}">Delete</button>
                    @include('admin.communion.communiondeletemodal')
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
            $('#communion-table').DataTable();

        });
    </script>
@endpush
