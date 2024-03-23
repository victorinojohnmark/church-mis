@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="color: #39B5A4;">First Communion Document Requests</h1>
                    <!-- Bell Icon with Notification Count -->
                    {{-- <a href="{{ route('usernotification') }}" class="">
                        <div class="position-relative" style="padding-right: 12px;">
                            <i class="fas fa-bell pr-3" style="font-size: 25px;"></i>
                            <span class="notification-pill badge bg-danger rounded-circle">{{ $notificationCount }}</span>
                        </div>
                        
                    </a> --}}
                </div>
                <hr>
                @include('layouts.message')
                @include('user.documentrequest.menu')
                <div class="py-3">
                    <a href="{{ route('client-documentrequestcommunioncreate') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Request</a>


                    <div class="table-responsive">
                        <table id="communionrequests-table" class="table table-hover">
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
                                                @if ($communionRequest->is_rejected)
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif ($communionRequest->is_ready)
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
                                            @if ($communionRequest->is_active && !$communionRequest->is_ready && !$communionRequest->is_rejected)
                                                <a href="{{ route('client-documentrequestcommunionshow', ['communionRequest' => $communionRequest->id]) }}" class="btn btn-primary btn-sm">{{ $communionRequest->is_ready ? 'View' : 'Update' }}</a>

                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#communionCancelDocumentRequestModal{{ $communionRequest->id }}">Cancel Request</button>
                                                @include('user.documentrequest.communion.communioncancelmodal')

                                            @else
                                                <button disabled="disabled" class="btn btn-secondary btn-sm">N/A</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            $('#communionrequests-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush