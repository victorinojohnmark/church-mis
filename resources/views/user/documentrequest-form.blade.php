<div class="row">
    @csrf
    <input type="hidden" name="user_id" value="{{ $documentRequest->id ? $documentRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $documentRequest->id ? $documentRequest->requested_date : date('Y-m-d') }}">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Document Type</label>
            <select name="document_type" class="form-control" required>
                <option selected disabled>Select here...</option>
                @forelse ($documentTypes as $documentType)
                <option value="{{ $documentType }}">{{ $documentType }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Payment Amount</label>
            <input type="number" name="payment_amount" value="{{ $documentRequest->id ? $documentRequest->payment_amount : '' }}" 
            class="form-control" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Proof of Payment</label>
            <input type="file" name="proof_of_payment" value="{{ $documentRequest->id ? $documentRequest->payment_amount : '' }}" 
            class="form-control" accept="image/*" required>
            <div class="form-text">
                Your G-Cash payment confirmation screenshot <br>
                Maximum of 5mb file size
            </div>
        </div>
    </div>
</div>