@extends('layouts.admin')

@section('title', 'Parishioners')

@section('content')
{{-- <div class="py-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#">Add Parishioners</button>
    
</div> --}}
<div class="table-responsive">
    <table id="parishioners-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birth Date</th>
                <th>Email</th>
                <th>Contact No#</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($parishioners as $parishioner)
                <tr>
                    <td>{{ $parishioner->name }}</td>
                    <td>{{ $parishioner->birth_date }}</td>
                    <td>{{ $parishioner->email }}</td>
                    <td>{{ $parishioner->contact_number }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#parishionerModal{{ $parishioner->id }}">View Details</button>
                        @include('admin.parishioner.parishionerdetailmodal')
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
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
            $('#parishioners-table').DataTable({

            });
            
        });

    </script>
@endpush
