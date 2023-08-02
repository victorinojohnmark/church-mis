@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')
{{-- <div class="py-3">

</div> --}}

{{ dd($notifications) }}
<table id="notification-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Message</th>
            <th>Date</th>
            
        </tr>
    </thead>
    <tbody>
        @forelse($baptisms as $baptism)
            <tr>
                <td>{{ $baptism->date }}</td>
                <td>{{ $baptism->birth_date }}</td>
                <td>{{ $baptism->created_at }}</td>

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
            $('#notification-table').DataTable();

        });
    </script>
@endpush
