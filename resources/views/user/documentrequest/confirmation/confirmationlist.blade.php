@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Confirmation Document Requests</h1>
                <hr>
                @include('layouts.message')
                @include('user.documentrequest.menu')
                <div class="py-3">
                    <a href="{{ route('client-documentrequestconfirmationcreate') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Request</a>

                    <div class="table-responsive">
                        <table id="confirmationrequests-table" class="table table-hover">
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
                                                @if ($confirmationRequest->is_rejected)
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif ($confirmationRequest->is_ready)
                                                    <span class="badge bg-success">Ready for pick up</span>
                                                @else
                                                    <span class="badge bg-warning">Pendings</span>
                                                @endif
                                            @else
                                                <span class="badge bg-danger">Cancelled by Client</span>
                                            @endif
                                        </td>
                                        <td>{{ $confirmationRequest->confirmation_date }}</td>
                                        <td>{{ $confirmationRequest->requested_date }}</td>
                                        <td>
                                            

                                            @if ($confirmationRequest->is_active && !$confirmationRequest->is_ready && !$confirmationRequest->is_rejected)
                                                <a href="{{ route('client-documentrequestconfirmationshow', ['confirmationRequest' => $confirmationRequest]) }}" class="btn btn-primary btn-sm">{{ $confirmationRequest->is_ready ? 'View' : 'Update' }}</a>

                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationCancelDocumentRequestModal{{ $confirmationRequest->id }}">Cancel Request</button>
                                                @include('user.documentrequest.confirmation.confirmationcancelmodal')
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
            $('#confirmationrequests-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush