@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1>Document Requests</h1>
                <hr>
                @include('layouts.message')
                <div class="py-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#documentRequestModal">Add Request</button>
                    <div class="modal fade" id="documentRequestModal" tabindex="-1" aria-labelledby="documentRequestModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="documentRequestModalLabel">Document Request Form</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="{{ route('documentrequestsave') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @include('user.documentrequest-form')
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>

                          </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="users-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Request Code</th>
                                <th>Document Type</th>
                                <th>Date Requested</th>
                                <th>Payment Amount</th>
                                <th>Status</th>
                                <th>Options</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentRequests as $documentRequest)
                                <tr>
                                    <td>{{ $documentRequest->request_code }}</td>
                                    <td>{{ $documentRequest->document_type }}</td>
                                    <td>{{ $documentRequest->requested_date }}</td>
                                    <td>{{ $documentRequest->payment ? 'Php ' . number_format($documentRequest->payment->amount, 2) : 'N/A' }}</td>
                                    <td>{{ $documentRequest->status }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#documentRequestCancelModal{{ $documentRequest->id }}">Cancel</button>
                                        <div class="modal fade" id="documentRequestCancelModal{{ $documentRequest->id }}" tabindex="-1" aria-labelledby="documentRequestCancelModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="documentRequestCancelModalLabel">Cancellation of Request</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                    
                                                <form action="{{ route('documentrequestcancel') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $documentRequest->id }}">
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to cancel your request? <br> Please confirm.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-danger">Cancel Request</button>
                                                    </div>
                                                </form>
                    
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Add more columns as needed -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            $('#users-table').DataTable();
        });
    </script>
@endpush