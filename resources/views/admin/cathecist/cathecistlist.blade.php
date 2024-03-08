@extends('layouts.admin')

@section('title', 'Cathecists')

@section('content')
<div class="py-3">
    <a class="btn btn-success" href="{{ route('cathecistcreate') }}">Add Catechist</a>
    {{-- @include('admin.cathecist.cathecistdetailmodal') --}}
</div>
<div class="table-responsive">
    <table id="cathecists-table" class="table table-bordered table-hover">
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
            @forelse ($cathecists as $cathecist)
                <tr>
                    <td>{{ $cathecist->name }}</td>
                    <td>{{ $cathecist->birth_date }}</td>
                    <td>{{ $cathecist->email }}</td>
                    <td>{{ $cathecist->contact_number }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('cathecistshow', ['cathecist' => $cathecist->id]) }}">View Details</a>
                        {{-- @include('admin.cathecist.cathecistdetailmodal') --}}
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
            $('#cathecists-table').DataTable({

            });
            
        });

    </script>
@endpush
