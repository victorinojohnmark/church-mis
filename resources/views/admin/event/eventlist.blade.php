@extends('layouts.admin')

@section('title', 'Events Posting')

@section('content')
<div class="py-3">
    <a href="#" class="btn btn-success">Create Event</a>
</div>
<div class="table-responsive">
    <table id="events-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Event Date</th>
                <th>Created at</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
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
            $('#events-table').DataTable({

            });
            
        });

    </script>
@endpush
