@extends('layouts.admin')

@section('title', 'Wedding')

@section('content')
@include('admin.reservation.reservation-menu')
{{-- <div class="py-3">

</div> --}}
<table id="matrimony-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Groom and Bride's Name</th>
            <th>Wedding Date</th>
            <th>Submitted At</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($matrimonies as $matrimony)
        <tr>
            <td>
                {{ $matrimony->grooms_name }} / {{ $matrimony->brides_name }}
                @if ($matrimony->is_accepted)
                    <span class="badge bg-success">Accepted</span>
                @elseif ($matrimony->is_rejected)
                    <span class="badge bg-danger">Rejected</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </td>
            <td>{{ $matrimony->wedding_date }}</td>
            <td>{{ $matrimony->created_at }}</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#matrimonyModal{{ $matrimony->id }}">View</button>
                @include('admin.matrimony.matrimonymodal')

                @if (!$matrimony->is_accepted && !$matrimony->is_rejected)
                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#matrimonyAcceptModal{{ $matrimony->id }}">Accept</button>
                    @include('admin.matrimony.matrimonyacceptmodal')
                
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#matrimonyRejectModal{{ $matrimony->id }}">Reject</button>
                    @include('admin.matrimony.matrimonyrejectmodal')
                @endif

                @if ($matrimony->is_accepted)
                    <form action="{{ route('matrimony.delete', $matrimony->id) }}" method="POST" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endif
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
