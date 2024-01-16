@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="color: #39B5A4;">Blessing</h1>
                    <!-- Bell Icon with Notification Count -->
                    <a href="{{ route('usernotification') }}" class="">
                        <div class="position-relative" style="padding-right: 12px;">
                            <i class="fas fa-bell pr-3" style="font-size: 25px;"></i>
                            <span class="notification-pill badge bg-danger rounded-circle">{{ $notificationCount }}</span>
                        </div>
                        
                    </a>
                </div>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <a href="{{ route('clientblessingcreate') }}" class="btn btn-success btn-sm">Create Blessing Reservation</a>
                </div>
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
                            <td>
                                {{ $blessing->name }}
                                @if ($blessing->is_accepted)
                                    <span class="badge bg-success">Accepted</span>
                                @elseif ($blessing->is_rejected)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $blessing->blessing_type }}</td>
                            <td>{{ $blessing->date }}</td>
                            <td>{{ $blessing->time }}</td>
                            <td>{{ $blessing->address }}</td>

                            <td>
                                <a href="{{ route('clientblessingshow', ['blessing' => $blessing->id]) }}" class="btn btn-primary btn-sm">View</a>
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