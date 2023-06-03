<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $matrimonyRequest->id ? $matrimonyRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $matrimonyRequest->id ? $matrimonyRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $matrimonyRequest->id ? $matrimonyRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-6">
        <label class="form-label">Groom's Name</label>
        <input type="text" name="grooms_name" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->grooms_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Grooms Birth Date</label>
        <input type="date" name="grooms_birth_date" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->grooms_birth_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Bride's Name</label>
        <input type="text" name="brides_name" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->brides_name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Bride's Birth Date</label>
        <input type="date" name="brides_birth_date" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->brides_birth_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-4">
        <label class="form-label">Matrimony Date</label>
        <input type="date" name="matrimony_date" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->matrimony_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->contact_number : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." readonly>{{ $matrimonyRequest->address }}</textarea>
    </div>

</div>