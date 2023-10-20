<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deathDocumentRequestRejectModal{{ $deathRequest->id }}">Reject Request</button>
<div class="modal fade" id="deathDocumentRequestRejectModal{{ $deathRequest->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Reject request</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('documentrequestdeathreject') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $deathRequest->id }}">
                        <p>Please confirm to set the requested document as rejected.</p>

                        <label for="" class="form-label fw-semibold">Message</label>
                        <textarea name="rejection_message" class="form-control mb-3" cols="30" rows="3" placeholder="Your message here"></textarea>
                        <small><i class="fa-solid fa-circle-info text-primary"></i>
                            <span class="text-secondary">An email will be sent to the user upon rejection.</span></small>
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