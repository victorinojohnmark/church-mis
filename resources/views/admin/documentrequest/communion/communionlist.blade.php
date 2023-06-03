@extends('layouts.admin')

@section('title', 'Communion Document Requests')

@section('content')
@include('admin.documentrequest.menu')

<div class="table-responsive">
    <table id="documentrequests-communion-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Communion</th>
                <th>Date Requested</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($communionRequests as $communionRequest)
                <tr>
                    <td>
                        {{ $communionRequest->name }}
                        @if ($communionRequest->is_active)
                            @if ($communionRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        @else
                        <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                    </td>
                    <td>{{ $communionRequest->communion_date }}</td>
                    <td>{{ $communionRequest->requested_date }}</td>
                    <td>
                        @include('admin.documentrequest.communion.communionmodal')

                        @if ($communionRequest->is_active && !$communionRequest->is_ready)
                            @include('admin.documentrequest.communion.communionreadymodal')
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
            $('#documentrequests-communion-table').DataTable({

            });
            
        });

    </script>
@endpush
