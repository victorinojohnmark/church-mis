@extends('layouts.admin')

@section('title', 'Blessing')

@section('content')
@include('layouts.message')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="blessing-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Address</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($blessings as $blessing)
        <tr>
            <td>{{ $blessing->name }}</td>
            <td>{{ $blessing->blessing_type }}</td>
            <td>{{ $blessing->date }}</td>
            <td>{{ $blessing->time }}</td>
            <td>{{ $blessing->address }}</td>

            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#blessingModal{{ $blessing->id }}">View</button>
                <div class="modal fade" id="blessingModal{{ $blessing->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Blessing Reservation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                                <div class="modal-body">
                                    @include('admin.blessing.blessingform')
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @empty
            
        @endforelse
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
            $('#blessing-table').DataTable();

        });
    </script>
@endpush
