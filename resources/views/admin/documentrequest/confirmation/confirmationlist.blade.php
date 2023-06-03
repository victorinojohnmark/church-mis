@extends('layouts.admin')

@section('title', 'Confirmation Document Requests')

@section('content')
@include('admin.documentrequest.menu')

<div class="table-responsive">
    <table id="documentrequests-baptism-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Confirmation</th>
                <th>Date Requested</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($confirmationRequests as $confirmationRequest)
                <tr>
                    <td>
                        {{ $confirmationRequest->name }}
                        @if ($confirmationRequest->is_active)
                            @if ($confirmationRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        @else
                        <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                    </td>
                    <td>{{ $confirmationRequest->confirmation_date }}</td>
                    <td>{{ $confirmationRequest->requested_date }}</td>
                    <td>
                        @include('admin.documentrequest.confirmation.confirmationmodal')

                        @if ($confirmationRequest->is_active && !$confirmationRequest->is_ready)
                            @include('admin.documentrequest.confirmation.confirmationreadymodal')
                        @endif
                        
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</div>

@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#documentrequests-baptism-table').DataTable({

            });
            
        });

    </script>
@endpush
