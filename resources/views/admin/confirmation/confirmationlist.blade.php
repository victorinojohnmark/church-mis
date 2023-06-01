@extends('layouts.admin')

@section('title', 'Confirmation')

@section('content')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="confirmation-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Birth Date</th>
            <th>Submitted At</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($confirmations as $confirmation)
        <tr>
            <td>
                {{ $confirmation->name }}
                @if ($confirmation->is_accepted)
                    <span class="badge bg-success">Accepted</span>
                @elseif ($confirmation->is_rejected)
                    <span class="badge bg-danger">Rejected</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </td>
            <td>{{ $confirmation->birth_date }}</td>
            <td>{{ $confirmation->created_at }}</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $confirmation->id }}">View</button>
                @include('admin.confirmation.confirmationmodal')

                @if (!$confirmation->is_accepted && !$confirmation->is_rejected)
                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#confirmationAcceptModal{{ $confirmation->id }}">Accept</button>
                    @include('admin.confirmation.confirmationacceptmodal')
                
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationRejectModal{{ $confirmation->id }}">Reject</button>
                    @include('admin.confirmation.confirmationrejectmodal')
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
            $('#confirmation-table').DataTable();

        });
    </script>
@endpush
