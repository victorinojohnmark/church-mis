{{-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#blessingDocumentRequestModal{{ $blessingRequest->id ? $documentRequest->id : ''  }}"><i class="fa-solid fa-plus"></i> blessing</button> --}}
<div class="modal fade" id="blessingDocumentRequestModal{{ $blessingRequest->id ? $blessingRequest->id : ''  }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="blessingDocumentRequestModalLabel">Blessing Document Request Form</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('client-documentrequestblessingsave') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                @include('user.documentrequest.blessing.blessingform')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>

        </div>
    </div>
</div>