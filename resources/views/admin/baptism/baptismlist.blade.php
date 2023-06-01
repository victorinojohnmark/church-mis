@extends('layouts.admin')

@section('title', 'Baptism')

@section('content')
@include('layouts.message')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="baptism-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Birth Date</th>
            <th>Submitted At</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse($baptisms as $baptism)
            <tr>
                <td>{{ $baptism->name }}</td>
                <td>{{ $baptism->birth_date }}</td>
                <td>{{ $baptism->created_at }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#baptismModal{{ $baptism->id }}">View</button>
                    <div class="modal fade" id="baptismModal{{ $baptism->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Baptism Reservation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                    <div class="modal-body">
                                    @include('admin.baptism.baptismform')
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
            $('#baptism-table').DataTable();

        });
    </script>
@endpush
