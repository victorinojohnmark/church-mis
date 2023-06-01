@extends('layouts.admin')

@section('title', 'Funeral')

@section('content')
@include('layouts.message')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="funeral-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date of Mass</th>
            <th>Time</th>
            <th>Age</th>
            <th>Address</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($funerals as $funeral)
        <tr>
            <td>{{ $funeral->name }}</td>
            <td>{{ $funeral->date }}</td>
            <td>{{ $funeral->time }}</td>
            <td>{{ $funeral->age }}</td>
            <td>{{ $funeral->address }}</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#funeralModal{{ $funeral->id }}">View</button>
                <div class="modal fade" id="funeralModal{{ $funeral->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Funeral Mass Reservation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                                <div class="modal-body">
                                    @include('admin.funeral.funeralform')
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
            $('#funeral-table').DataTable();

        });
    </script>
@endpush
