<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $baptismRequest->id ? $baptismRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $baptismRequest->id ? $baptismRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $baptismRequest->id ? $baptismRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12">
        <label class="form-label">Name of the Baby</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        {{-- <label class="form-label">Baptismal Date</label> --}}
        <div class="d-flex justify-content-between">
            <label class="form-label">Baptismal Date</label>
            <div class="unknown">
                <input type="checkbox" name="is_unknown_date" class="form-check-input" {{ $baptismRequest->baptismal_date == null ? 'checked' : '' }} onclick="return false;" readonly>
                <label class="form-check-label">&nbsp; Unknown date of baptismal</label>
            </div>
        </div>
        <input type="date" name="baptismal_date" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->baptismal_date : '' }}" placeholder="..." readonly>

    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->birth_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->contact_number : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->father_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->mother_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." readonly>{{ $baptismRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ $baptismRequest->id ? $baptismRequest->purpose : '' }}" placeholder="..." readonly>
    </div>

</div>