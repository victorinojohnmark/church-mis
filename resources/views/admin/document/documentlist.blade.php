@extends('layouts.admin')

@section('title', 'Documents')

@section('content')
<div class="py-3">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Add Document</button>  
    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addDocumentModalLabel">Verify Payment</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <form action="{{ route('documentsave') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @include('admin.document.documentform')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    
          </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="documents-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Document</th>
                <th>Date</th>
                <th>File</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
                <tr>
                    <td>{{ $document->parishioner->name }}</td>
                    <td>{{ $document->document_type }}</td>
                    <td>{{ $document->date }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDocumentView{{ $document->id }}">View</button>
                        <div class="modal fade" id="modalDocumentView{{ $document->id }}" tabindex="-1" aria-labelledby="modalDocumentView{{ $document->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="modalDocumentView{{ $document->id }}Label">View Document</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        
                                <div class="modal-body">
                                    <img class="img-responsive" src="{{ '/storage/documents/' . $document->filename }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        
                              </div>
                            </div>
                        </div>
                    </td>
                    <td></td>
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
            $('#documents-table').DataTable({

            });
            
        });

    </script>
@endpush
