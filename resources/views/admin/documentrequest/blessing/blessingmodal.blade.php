<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#blessingDocumentRequestModal{{ $blessingRequest->id }}">View</button>
<div class="modal fade" id="blessingDocumentRequestModal{{ $blessingRequest->id ? $blessingRequest->id : ''  }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="blessingDocumentRequestModalLabel">Blessing Document Request Form</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            @include('admin.documentrequest.blessing.blessingform')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>