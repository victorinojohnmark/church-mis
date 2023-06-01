<div class="modal fade" id="matrimonyRejectModal{{ $matrimony->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Reject Matrimony Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('matrimonyreject') }}" method="post">
                    @csrf <input type="hidden" name="id" value="{{ $matrimony->id }}">
                    <div class="modal-body">
                        <p>Please confirm to reject the reservation.</p>
                        <label for="" class="form-label fw-semibold">Message</label>
                        <textarea name="rejection_message" class="form-control mb-3" cols="30" rows="3" placeholder="Your message here"></textarea>
                        <small><i class="fa-solid fa-circle-info text-primary"></i>
                            <span class="text-secondary">An email will be sent to the user to reject their reservation.</span></small>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reject Reservation</button>
                    </div>
                </form>
        </div>
    </div>
</div>