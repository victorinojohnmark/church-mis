<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#baptismDocumentRequestModal{{ $baptismRequest->id }}">View</button>
<div class="modal fade" id="baptismDocumentRequestModal{{ $baptismRequest->id ? $baptismRequest->id : ''  }}" tabindex="-1" aria-labelledby="documentRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="baptismDocumentRequestModalLabel">Baptism Document Request Form</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            @include('admin.documentrequest.baptism.baptismform')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>