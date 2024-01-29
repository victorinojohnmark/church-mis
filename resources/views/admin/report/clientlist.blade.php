@extends('layouts.admin')

@section('title', 'Report - Clients')

@section('content')
{{-- <div class="py-3">
    
</div> --}}
<div class="table-responsive pt-2">
    <table id="document-table" class="table table-hover table-bordered">
    
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact #</th>
                <th>Email Address</th>
                <th>Date Registered</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clients as $client)
                <tr>
                    <td>{!! $client->name !!}</td>
                    <td>{!! $client->contact_number !!}</td>
                    <td>{!! $client->email !!}</td>
                    <td>{!! $client->created_at !!}</td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
        
    </table>
</div>

{{-- <a href="{{ route('report-clientlist') }}" class="btn btn-primary">Refresh List</a> --}}

@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables.net/datatables.min.css">
@endpush

@push('scripts')
    <script src="/vendor/datatables.net/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#document-table').DataTable({
                oLanguage: {
                    sSearch: "Quick Search"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: 'Copy'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        title: 'Saint Gregory the Great Parish Church' // Set your desired title here
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        title: 'Saint Gregory the Great Parish Church'
                    }
                ]
            });


        });
    </script>
@endpush
