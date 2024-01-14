@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Wedding</h1>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <a href="{{ route('clientmatrimonycreate') }}" class="btn btn-success btn-sm">Create Wedding Reservation</a>
                </div>
                <table id="baptism-table" class="table table-hover table-bordered">
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
                                <a href="{{ route('clientmatrimonyshow', ['matrimony' => $matrimony->id]) }}" class="btn btn-primary btn-sm">View</a>
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