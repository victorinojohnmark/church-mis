@extends('layouts.admin')

@section('title', 'Matrimony')

@section('content')
@include('layouts.message')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="matrimony-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Broom and Bride's Name</th>
            <th>Wedding Date</th>
            <th>Submitted At</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($matrimonies as $matrimony)
        <tr>
            <td>{{ $matrimony->grooms_name }} / {{ $matrimony->brides_name }}</td>
            <td>{{ $matrimony->wedding_date }}</td>
            <td>{{ $matrimony->created_at }}</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#matrimonyModal{{ $matrimony->id }}">View</button>
                <div class="modal fade" id="matrimonyModal{{ $matrimony->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Matrimony Reservation Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                                <div class="modal-body">
                                    @include('admin.matrimony.matrimonyform')
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
            $('#matrimony-table').DataTable();

        });
    </script>
@endpush
