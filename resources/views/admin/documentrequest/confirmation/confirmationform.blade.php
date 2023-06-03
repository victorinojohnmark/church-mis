<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $confirmationRequest->id ? $confirmationRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $confirmationRequest->id ? $confirmationRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $confirmationRequest->id ? $confirmationRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-4">
        <label class="form-label">Confirmation Date</label>
        <input type="date" name="confirmation_date" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->baptismal_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->birth_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->contact_number : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->father_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->mother_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." readonly>{{ $confirmationRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->purpose : '' }}" placeholder="..." readonly>
    </div>

</div>