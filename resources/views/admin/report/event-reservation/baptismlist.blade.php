@extends('layouts.admin')

@section('title', 'Report - Baptism Event Reservation')

@section('content')
<div class="py-3">
    @include('admin.report.event-reservation.event-reservation-menu') 

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
                        <label class="form-label">Submitted Date Range</label>
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
<div class="table-responsive">
    <table id="baptism-table" class="table table-hover table-bordered">
    
        <thead>
            <tr>
                <th>Name</th>
                <th>Baptismal Date</th>
                <th>Contact #</th>
                <th>Present Address</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Submitted By</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($baptisms as $baptism)
            <tr>
                <td>{!! $baptism->name !!}</td>
                <td>{!! $baptism->date !!}</td>
                <td>{!! $baptism->contact_number !!}</td>
                <td>{!! $baptism->present_address !!}</td>
                <td>{!! $baptism->status !!}</td>
                <td>{!! $baptism->created_at->format('Y-m-d') !!}</td>
                <td>{!! $baptism->createdBy->name !!}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
        
    </table>
</div>

<a href="{{ route('report-baptismlist') }}" class="btn btn-primary">Refresh List</a>





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
                        text: 'Copy'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        title: 'Saint Gregory the Great Parish Church' // Set your desired title here
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        title: 'Saint Gregory the Great Parish Church'
                    }
                ]
            });


        });
    </script>
@endpush
