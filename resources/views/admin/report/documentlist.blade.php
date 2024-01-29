@extends('layouts.admin')

@section('title', 'Report - Documents')

@section('content')
<div class="py-3">
    <div class="card rounded-0">
        <div class="card-header bg-light" data-bs-toggle="collapse" href="#collapseSearchPane">
            <strong>Search Panel</strong>
            
        </div>
        <div id="collapseSearchPane" class="collapse">
            <div class="card-body">
                <form action="#" class="row" method="POST">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Document Type</label>
                        <select name="document_type" class="form-control">
                            <option selected disabled>Select here...</option>
                            @forelse ($documentTypes as $documentType)
                            <option value="{{ $documentType }}">{{ $documentType }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date Range Uploaded</label>
                        <div class="input-group">
                            <input type="date" name="daterange_start" class="form-control">
                            <input type="date" name="daterange_end" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" type="submit">Search</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="document-table" class="table table-hover table-bordered">
    
        <thead>
            <tr>
                <th>Name</th>
                <th>Document Type</th>
                <th>Date Upload</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
            <tr>
                <td>{!! $document->name !!}</td>
                <td>{!! $document->document_type !!}</td>
                <td>{!! $document->created_at->format('Y-m-d') !!}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
        
    </table>
</div>

<a href="{{ route('report-documentlist') }}" class="btn btn-primary">Refresh List</a>





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
