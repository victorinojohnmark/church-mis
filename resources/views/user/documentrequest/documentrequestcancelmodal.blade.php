<div class="modal fade" id="documentRequestCancelModal{{ $documentRequest->id }}" tabindex="-1" aria-labelledby="documentRequestCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="documentRequestCancelModalLabel">Cancellation of Request</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('documentrequestcancel') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $documentRequest->id }}">
            <div class="modal-body">
                <p>Are you sure you want to cancel your request? <br> Please confirm.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Cancel Request</button>
            </div>
        </form>

      </div>
    </div>
</div>