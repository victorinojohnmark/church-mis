@extends('layouts.admin')

@section('title', 'Report - Confirmation Document Requests')

@section('content')
<div class="py-3">
    @include('admin.report.document-request.document-request-menu') 

    <div class="card rounded-0">
        <div class="card-header bg-light" data-bs-toggle="collapse" href="#collapseSearchPane">
            <strong>Search Panel</strong>
            
        </div>
        <div id="collapseSearchPane" class="collapse">
            <div class="card-body">
                <form action="#" class="row" method="POST">
                    @csrf
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Confirmation Date Range</label>
                        <div class="input-group">
                            <input type="date" name="confirmation_start" class="form-control">
                            <input type="date" name="confirmation_end" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Requested Date Range</label>
                        <div class="input-group">
                            <input type="date" name="daterange_start" class="form-control">
                            <input type="date" name="daterange_end" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<table id="confirmation-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Confirmation Date</th>
            <th>Contact #</th>
            {{-- <th>Status</th> --}}
            <th>Purpose</th>
            <th>Requested Date</th>
            <th>Submitted By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($confirmationRequests as $confirmationRequest)
            <tr>
                <td>{!! $confirmationRequest->name !!}</td>
                <td>{!! $confirmationRequest->confirmation_date !!}</td>
                <td>{!! $confirmationRequest->contact_number !!}</td>
                {{-- <td>{!! $confirmationRequest->status !!}</td> --}}
                <td>{!! $confirmationRequest->purpose !!}</td>
                <td>{!! $confirmationRequest->created_at->format('Y-m-d') !!}</td>
                <td>{!! $confirmationRequest->createdBy->name !!}</td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>

<a href="{{ route('report-docrequest-confirmation') }}" class="btn btn-primary">Refresh List</a>





@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables.net/datatables.min.css">
@endpush

@push('scripts')
    <script src="/vendor/datatables.net/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#confirmation-table').DataTable({
                oLanguage: {
                    sSearch: "Quick Search"
                },
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'print'
                ]
            });


        });
    </script>
@endpush
