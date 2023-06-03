<div class="modal fade" id="baptismCancelDocumentRequestModal{{ $baptismRequest->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="baptismCancelDocumentRequestModalLabel">Cancel Baptism Document Request</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('client-canceldocumentrequestbaptism') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="id" value="{{ $baptismRequest->id }}">
                Are you sure you want to cancel the request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if (!$baptismRequest->is_ready)
                <button type="submit" class="btn btn-danger">Cancel Request</button>
                @endif
            </div>
        </form>

        </div>
    </div>
</div>