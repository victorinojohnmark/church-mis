@extends('layouts.admin')

@section('title', 'Death Document Requests')

@section('content')
@include('admin.documentrequest.menu')

<div class="table-responsive">
    <table id="documentrequests-death-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Death</th>
                <th>Date Requested</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($deathRequests as $deathRequest)
                <tr>
                    <td>
                        {{ $deathRequest->name }}
                        @if ($deathRequest->is_active)
                            @if ($deathRequest->is_rejected)
                                <span class="badge bg-danger">Rejected</span>
                            @elseif ($deathRequest->is_ready)
                                <span class="badge bg-success">Ready for pick up</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        @else
                            <span class="badge bg-danger">Cancelled by Client</span>
                        @endif
                    </td>
                    <td>{{ $deathRequest->date_of_death }}</td>
                    <td>{{ $deathRequest->requested_date }}</td>
                    <td>
                        @include('admin.documentrequest.death.deathmodal')

                        @if ($deathRequest->is_active && !$deathRequest->is_ready && !$deathRequest->is_rejected)
                            @include('admin.documentrequest.death.deathreadymodal')
                            @include('admin.documentrequest.death.deathrejectmodal')
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
            $('#documentrequests-death-table').DataTable({

            });
            
        });

    </script>
@endpush
