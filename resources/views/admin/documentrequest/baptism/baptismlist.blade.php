@extends('layouts.admin')

@section('title', 'Baptism Document Requests')

@section('content')
@include('admin.documentrequest.menu')

<div class="table-responsive">
    <table id="documentrequests-baptism-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Baptismal</th>
                <th>Date Requested</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($baptismRequests as $baptismRequest)
                <tr>
                    <td>
                        {{ $baptismRequest->name }}
                        @if ($baptismRequest->is_active)
                            @if ($baptismRequest->is_rejected)
                                <span class="badge bg-danger">Rejected</span>
                            @elseif ($baptismRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pendings</span>
                            @endif
                        @else
                            <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                        @if (!$baptismRequest->baptism)
                        <span class="badge bg-danger">No Record</span>
                        @endif
                    </td>
                    <td>{{ $baptismRequest->baptismal_date ?? 'N/A' }}</td>
                    <td>{{ $baptismRequest->requested_date }}</td>
                    <td>
                        @include('admin.documentrequest.baptism.baptismmodal')

                        @if ($baptismRequest->is_active && !$baptismRequest->is_ready && !$baptismRequest->is_rejected)
                            @include('admin.documentrequest.baptism.baptismreadymodal')
                            @include('admin.documentrequest.baptism.baptismrejectmodal')
                        @endif
                        
                        @if ($baptismRequest->baptism)
                            <a href="{{ route('baptismprint', ['baptism' => $baptismRequest->baptism->id]) }}" target="_blank"  class="btn btn-success btn-sm">Print Preview</a>
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
