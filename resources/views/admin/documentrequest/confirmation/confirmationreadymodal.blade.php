<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDocumentRequestReadyModal{{ $confirmationRequest->id }}">Ready for pick up</button>
<div class="modal fade" id="confirmationDocumentRequestReadyModal{{ $confirmationRequest->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Confirm Document</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('documentrequestconfirmationsetready') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $confirmationRequest->id }}">
                        <p>Please confirm to set the requested document as ready to pick up.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
        </div>
    </div>
</div>