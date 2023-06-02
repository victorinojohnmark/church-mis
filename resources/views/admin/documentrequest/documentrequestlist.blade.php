@extends('layouts.admin')

@section('title', 'Document Requests')

@section('content')
{{-- <div class="py-3">

</div> --}}

<div class="table-responsive">
    <table id="documentrequests-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Requested By</th>
                <th>Name</th>
                <th>Document</th>
                <th>Date Submitted</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documentRequests as $documentRequest)
                <tr>
                    <td>{{ $documentRequest->createdBy->name }}</td>
                    <td>
                        {{ $documentRequest->name }}
                        @if ($documentRequest->is_active)
                            @if ($documentRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        @else
                        <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                    </td>
                    <td>{{ $documentRequest->document_type }}</td>
                    <td>{{ $documentRequest->requested_date }}</td>
                    <td>
                        @if ($documentRequest->is_active)
                            @if (!$documentRequest->is_ready)
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#documentrequestReadyModal{{ $documentRequest->id }}">Ready for pick up</button>
                                @include('admin.documentrequest.documentrequestreadymodal')
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>N/A</button>
                            @endif
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>N/A</button>
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
            $('#documentrequests-table').DataTable({

            });
            
        });

    </script>
@endpush
