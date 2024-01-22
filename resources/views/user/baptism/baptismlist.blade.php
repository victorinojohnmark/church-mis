@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="color: #39B5A4;">Baptism</h1>
                    <!-- Bell Icon with Notification Count -->
                    {{-- <a href="{{ route('usernotification') }}" class="">
                        <div class="position-relative" style="padding-right: 12px;">
                            <i class="fas fa-bell pr-3" style="font-size: 25px;"></i>
                            <span class="notification-pill badge bg-danger rounded-circle">{{ $notificationCount }}</span>
                        </div>
                        
                    </a> --}}
                </div>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <a href="{{ route('clientbaptismcreate') }}" class="btn btn-success btn-sm">Create Baptism Reservation</a>
                    {{-- <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#baptismFormModal">Create Baptism Reservation</button>
                    <div class="modal fade" id="baptismFormModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Baptism Reservation Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('clientbaptismsave') }}" method="post">
                                    <input type="hidden" name="created_by_id" value="{{ Auth::id() }}">
                                    @csrf
                                    <div class="modal-body">
                                        @include('user.baptism.baptismform')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <table id="baptism-table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Baptismal Date</th>
                            <th>Birth Date</th>
                            <th>Submitted At</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($baptisms as $baptism)
                        <tr>
                            <td>
                                {{ $baptism->name }}
                                @if ($baptism->is_accepted)
                                    <span class="badge bg-success">Accepted</span>
                                @elseif ($baptism->is_rejected)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $baptism->date }}</td>
                            <td>{{ $baptism->birth_date }}</td>
                            <td>{{ $baptism->created_at }}</td>
                            <td>
                                <a href="{{ route('clientbaptismshow', ['baptism' => $baptism->id]) }}" class="btn btn-primary btn-sm">View</button>
                                {{-- <div class="modal fade" id="baptismModal{{ $baptism->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Baptism Reservation Form</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('clientbaptismsave') }}" method="post">
                                                <div class="modal-body">
                                                    @include('user.baptism.baptismform')
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
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
            $('#baptism-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush