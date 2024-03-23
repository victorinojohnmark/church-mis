@extends('layouts.admin')

@section('title', 'Matrimony Document Requests')

@section('content')
@include('admin.documentrequest.menu')

<div class="table-responsive">
    <table id="documentrequests-matrimony-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Matrimony</th>
                <th>Requested By</th>
                <th>Date Requested</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matrimonyRequests as $matrimonyRequest)
                <tr>
                    <td>
                        {{ $matrimonyRequest->grooms_name }} / {{ $matrimonyRequest->brides_name }}
                        @if ($matrimonyRequest->is_active)
                            @if ($matrimonyRequest->is_rejected)
                                <span class="badge bg-danger">Rejected</span>
                            @elseif ($matrimonyRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        @else
                            <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                    </td>
                    <td>{{ $matrimonyRequest->matrimony_date }}</td>
                    <td>{{ $matrimonyRequest->createdBy->name }}</td>
                    <td>{{ $matrimonyRequest->requested_date }}</td>
                    <td>
                        
                        @include('admin.documentrequest.matrimony.matrimonymodal')
                        @if ($matrimonyRequest->is_active && !$matrimonyRequest->is_ready && !$matrimonyRequest->is_rejected)
                            @include('admin.documentrequest.matrimony.matrimonyreadymodal')
                            @include('admin.documentrequest.matrimony.matrimonyrejectmodal')
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
            $('#documentrequests-matrimony-table').DataTable({

            });
            
        });

    </script>
@endpush
