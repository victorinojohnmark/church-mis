@extends('layouts.admin')

@section('title', 'Report - Baptism Document Requests')

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
                        <label class="form-label">Baptismal Date Range</label>
                        <div class="input-group">
                            <input type="date" name="baptism_start" class="form-control">
                            <input type="date" name="baptism_end" class="form-control">
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
<table id="baptism-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Baptismal Date</th>
            <th>Contact #</th>
            <th>Status</th>
            <th>Purpose</th>
            <th>Requested Date</th>
            <th>Submitted By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($baptismRequests as $baptismRequest)
            <tr>
                <td>{!! $baptismRequest->name !!}</td>
                <td>{!! $baptismRequest->baptismal_date ?? 'N/A' !!}</td>
                <td>{!! $baptismRequest->contact_number !!}</td>
                <td>{!! $baptismRequest->status !!}</td>
                <td>{!! $baptismRequest->purpose !!}</td>
                <td>{!! $baptismRequest->created_at->format('Y-m-d') !!}</td>
                <td>{!! $baptismRequest->createdBy->name !!}</td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>

<a href="{{ route('report-docrequest-baptism') }}" class="btn btn-primary">Refresh List</a>





@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables.net/datatables.min.css">
@endpush

@push('scripts')
    <script src="/vendor/datatables.net/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#baptism-table').DataTable({
                oLanguage: {
                    sSearch: "Quick Search"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:eq(3))' // Exclude 4th column (index 3)
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:eq(3))' // Exclude 4th column (index 3)
                        }
                    },
                    'print'
                ]
            });
        });
        </script>
@endpush
