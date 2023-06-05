@extends('layouts.admin')

@section('title', 'Report - Blessing Document Requests')

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
                        @php
                            $types = ['House', 'Apartment', 'Business', 'Car'];
                        @endphp
                        <label class="form-label">Type</label>
                        <select name="blessing_type" class="form-control" required>
                            @forelse ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Blessing Date Range</label>
                        <div class="input-group">
                            <input type="date" name="blessing_start" class="form-control">
                            <input type="date" name="blessing_end" class="form-control">
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
<table id="blessing-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Blessing Date</th>
            <th>Type</th>
            <th>Contact #</th>
            <th>Status</th>
            <th>Requested Date</th>
            <th>Submitted By</th>
        </tr>
    </thead>
    <tbody>
        @forelse($blessingRequests as $blessingRequest)
            <tr>
                <td>{!! $blessingRequest->name !!}</td>
                <td>{!! $blessingRequest->blessing_date !!}</td>
                <td>{!! $blessingRequest->blessing_type !!}</td>
                <td>{!! $blessingRequest->contact_number !!}</td>
                <td>{!! $blessingRequest->status !!}</td>
                <td>{!! $blessingRequest->created_at->format('Y-m-d') !!}</td>
                <td>{!! $blessingRequest->createdBy->name !!}</td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>

<a href="{{ route('report-docrequest-blessing') }}" class="btn btn-primary">Refresh List</a>





@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables.net/datatables.min.css">
@endpush

@push('scripts')
    <script src="/vendor/datatables.net/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#blessing-table').DataTable({
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
