<div class="modal fade" id="documentRequestModal{{ $documentRequest->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Document Request Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('documentrequestsave') }}" method="post">
                    @csrf <input type="hidden" name="id" value="{{ $documentRequest->id }}">
                    <div class="modal-body">
                       @include('user.documentrequest.documentrequest-form')
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm Reservation</button>
                    </div>
                </form>
        </div>
    </div>
</div>