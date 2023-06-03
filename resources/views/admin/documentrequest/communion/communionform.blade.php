<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $communionRequest->id ? $communionRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $communionRequest->id ? $communionRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $communionRequest->id ? $communionRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-4">
        <label class="form-label">Communion Date</label>
        <input type="date" name="communion_date" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->baptismal_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->birth_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->contact_number : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->father_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->mother_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." readonly>{{ $communionRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->purpose : '' }}" placeholder="..." readonly>
    </div>

</div>