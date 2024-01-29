@extends('layouts.admin')

@section('title', 'Report - Funeral Event Reservation')

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
                        <label class="form-label">Funeral Date Range</label>
                        <div class="input-group">
                            <input type="date" name="funeral_start" class="form-control">
                            <input type="date" name="funeral_end" class="form-control">
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
    <table id="funeral-table" class="table table-hover table-bordered">
    
        <thead>
            <tr>
                <th>Name</th>
                <th>Funeral Date</th>
                <th>Cause of Death</th>
                <th>Contact #</th>
                <th>Address</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Submitted By</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($funerals as $funeral)
            <tr>
                <td>{!! $funeral->name !!}</td>
                <td>{!! $funeral->date !!}</td>
                <td>{!! $funeral->cause_of_death !!}</td>
                <td>{!! $funeral->contact_number !!}</td>
                <td>{!! $funeral->address !!}</td>
                <td>{!! $funeral->status !!}</td>
                <td>{!! $funeral->created_at->format('Y-m-d') !!}</td>
                <td>{!! $funeral->createdBy->name !!}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
        
    </table>
</div>

<a href="{{ route('report-funerallist') }}" class="btn btn-primary">Refresh List</a>





@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables.net/datatables.min.css">
@endpush

@push('scripts')
    <script src="/vendor/datatables.net/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#funeral-table').DataTable({
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
