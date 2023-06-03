<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $confirmationRequest->id ? $confirmationRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $confirmationRequest->id ? $confirmationRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $confirmationRequest->id ? $confirmationRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->name : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        <label class="form-label">Confirmation Date</label>
        <input type="date" name="confirmation_date" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->confirmation_date : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->birth_date : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->contact_number : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->father_name : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->mother_name : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>{{ $confirmationRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ $confirmationRequest->id ? $confirmationRequest->purpose : '' }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document in 3-5 business days. You'll recieve an email advisory when it's ready for pickup.
            </small>
        </div>
    </div>

</div>