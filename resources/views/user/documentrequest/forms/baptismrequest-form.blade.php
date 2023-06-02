<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $documentRequest->id ? $documentRequest->id : '' }}">
    <input type="hidden" name="document_request_id" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->document_request_id : $documentRequest->id }}">
    <input type="hidden" name="user_id" value="{{ $documentRequest->id ? $documentRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $documentRequest->id ? $documentRequest->requested_date : date('Y-m-d') }}">
    <input type="hidden" name="document_type" value="Baptism">

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->name : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Baptismal Date</label>
        <input type="date" name="baptismal_date" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->baptismal_date : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->birth_date : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->contact_number : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->father_name : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->mother_name : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." required></textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->baptismDetail->purpose : '' }}" placeholder="..." required>
    </div>

    <div class="col-md-12">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document in 3-5 business days, and we'll email you when it's ready for pickup.
            </small>
        </div>
    </div>

    

    {{-- <div class="col-md-6">
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
            <div class="form-text">Your G-Cash payment confirmation screenshot</div>
        </div>
    </div> --}}
</div>