@extends('layouts.admin')

@section('title', 'Report - Matrimony Document Requests')

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
                        <label class="form-label">Groom's Name</label>
                        <input type="text" name="grooms_name" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Bride's Name</label>
                        <input type="text" name="brides_name" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Matrimony Date Range</label>
                        <div class="input-group">
                            <input type="date" name="matrimony_start" class="form-control">
                            <input type="date" name="matrimony_end" class="form-control">
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
<table id="matrimony-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Groom's Name</th>
            <th>Bride's Name</th>
            <th>Matrimony Date</th>
            <th>Contact #</th>
            <th>Status</th>
            <th>Requested Date</th>
            <th>Submitted By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($matrimonyRequests as $matrimonyRequest)
            <tr>
                <td>{!! $matrimonyRequest->grooms_name !!}</td>
                <td>{!! $matrimonyRequest->brides_name !!}</td>
                <td>{!! $matrimonyRequest->matrimony_date !!}</td>
                <td>{!! $matrimonyRequest->contact_number !!}</td>
                <td>{!! $matrimonyRequest->status !!}</td>
                <td>{!! $matrimonyRequest->created_at->format('Y-m-d') !!}</td>
                <td>{!! $matrimonyRequest->createdBy->name !!}</td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>

<a href="{{ route('report-docrequest-matrimony') }}" class="btn btn-primary">Refresh List</a>





@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables.net/datatables.min.css">
@endpush

@push('scripts')
    <script src="/vendor/datatables.net/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#matrimony-table').DataTable({
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
