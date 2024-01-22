@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Notifications - Document Requests</h1>
                <hr>
                
                <table id="notification-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $notification)
                        <tr>
                            <td>{!! $notification->data['message'] !!}</td>
                            <td>{!! $notification->created_at->diffForHumans() !!}</td>
                            <td>
                                <a href="/user/notifications/{{ $notification->id }}/delete" class="text-danger">Delete</a>
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
            $('#notification-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush