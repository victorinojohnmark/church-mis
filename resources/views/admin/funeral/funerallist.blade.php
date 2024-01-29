@extends('layouts.admin')

@section('title', 'Funeral')

@section('content')
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
            <td>
                {{ $funeral->name }}
                @if ($funeral->is_accepted)
                    <span class="badge bg-success">Accepted</span>
                @elseif ($funeral->is_rejected)
                    <span class="badge bg-danger">Rejected</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </td>
            <td>{{ $funeral->date }}</td>
            <td>{{ $funeral->time }}</td>
            <td>{{ $funeral->age }}</td>
            <td>{{ $funeral->address }}</td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#funeralModal{{ $funeral->id }}">View</button>
                @include('admin.funeral.funeralmodal')

                @if (!$funeral->is_accepted && !$funeral->is_rejected)
                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#funeralAcceptModal{{ $funeral->id }}">Accept</button>
                    @include('admin.funeral.funeralacceptmodal')
                
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#funeralRejectModal{{ $funeral->id }}">Reject</button>
                    @include('admin.funeral.funeralrejectmodal')
                @endif

                @if ($funeral->is_accepted)
                    <form action="{{ route('funeral.delete', $funeral->id) }}" method="POST" enctype="multipart/form-data">
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
            $('#funeral-table').DataTable();

        });
    </script>
@endpush
