<div class="modal fade" id="communionAcceptModal{{ $communion->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Accept Communion Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('communionaccept') }}" method="post">
                    @csrf <input type="hidden" name="id" value="{{ $communion->id }}">
                    <div class="modal-body">
                        <p>Please confirm to accept the reservation.</p>
                        <label for="" class="form-label fw-semibold">Message</label>
                        <textarea name="accepted_message" class="form-control mb-3" cols="30" rows="3" placeholder="Your message here"></textarea>
                        <small><i class="fa-solid fa-circle-info text-primary"></i>
                            <span class="text-secondary">An email will be sent to the user to confirm their reservation.</span></small>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm Reservation</button>
                    </div>
                </form>
        </div>
    </div>
</div>