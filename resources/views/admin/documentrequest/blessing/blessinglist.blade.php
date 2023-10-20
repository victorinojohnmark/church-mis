@extends('layouts.admin')

@section('title', 'Blessing Document Requests')

@section('content')
@include('admin.documentrequest.menu')

<div class="table-responsive">
    <table id="documentrequests-blessing-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Blessing Date</th>
                <th>Type</th>
                <th>Requested By</th>
                <th>Date Requested</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blessingRequests as $blessingRequest)
                <tr>
                    <td>
                        {{ $blessingRequest->name }}
                        @if ($blessingRequest->is_active)
                            @if ($blessingRequest->is_rejected)
                                <span class="badge bg-danger">Rejected</span>
                            @elseif ($blessingRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pendings</span>
                            @endif
                        @else
                            <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                    </td>
                    <td>{{ $blessingRequest->blessing_date }}</td>
                    <td>{{ $blessingRequest->blessing_type }}</td>
                    <td>{{ $blessingRequest->createdBy->name }}</td>
                    <td>{{ $blessingRequest->requested_date }}</td>
                    <td>
                        @include('admin.documentrequest.blessing.blessingmodal')
                        @if ($blessingRequest->is_active && !$blessingRequest->is_ready && !$blessingRequest->is_rejected)
                            @include('admin.documentrequest.blessing.blessingreadymodal')
                            @include('admin.documentrequest.blessing.blessingrejectmodal')
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
            $('#documentrequests-blessing-table').DataTable({

            });
            
        });

    </script>
@endpush
