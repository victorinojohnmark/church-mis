@extends('layouts.admin')

@section('title', 'Report - Clients')

@section('content')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="clients-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#clients-table').DataTable();

        });
    </script>
@endpush
