<div class="modal fade" id="communionDocumentRequestModal{{ $communionRequest->id ? $communionRequest->id : ''  }}" tabindex="-1" aria-labelledby="documentRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="communionDocumentRequestModalLabel">communion Document Request Form</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('client-documentrequestcommunionsave') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                @include('user.documentrequest.communion.communionform')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if (!$communionRequest->is_ready)
                <button type="submit" class="btn btn-success">Submit</button>
                @endif
            </div>
        </form>

        </div>
    </div>
</div>