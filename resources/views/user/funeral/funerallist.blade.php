@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Funeral</h1>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <a href="{{ route('clientfuneralcreate') }}" class="btn btn-success btn-sm">Create Funeral Mass Reservation</a>
                </div>
                <table id="blessing-table" class="table table-hover table-bordered">
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
                                <a href="{{ route('clientfuneralshow', ['funeral' => $funeral->id]) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
            $('#blessing-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush