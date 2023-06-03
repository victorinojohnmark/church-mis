@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1>Communion Document Requests</h1>
                <hr>
                @include('layouts.message')
                @include('user.documentrequest.menu')
                <div class="py-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#communionDocumentRequestModal"><i class="fa-solid fa-plus"></i> Add Request</button>
                    <div class="modal fade" id="communionDocumentRequestModal" tabindex="-1" aria-labelledby="documentRequestModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="communionDocumentRequestModalLabel">Communion Document Request Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                    
                            <form action="{{ route('client-documentrequestcommunionsave') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @include('user.documentrequest.communion.communionform')
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                    
                            </div>
                        </div>
                    </div>

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
                                            @if ($communionRequest->is_active)
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#communionDocumentRequestModal{{ $communionRequest->id }}">{{ $communionRequest->is_ready ? 'View' : 'Update' }}</button>
                                                @include('user.documentrequest.communion.communionmodal')

                                                @if (!$communionRequest->is_ready)
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#communionCancelDocumentRequestModal{{ $communionRequest->id }}">Cancel Request</button>
                                                    @include('user.documentrequest.communion.communioncancelmodal')
                                                @endif

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