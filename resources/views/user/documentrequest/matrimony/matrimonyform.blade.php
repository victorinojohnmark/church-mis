<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $matrimonyRequest->id ? $matrimonyRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $matrimonyRequest->id ? $matrimonyRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $matrimonyRequest->id ? $matrimonyRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                <strong>The Church Office is closed on Mondays and opens from Tuesdays to Saturdays, 8:00 AM to 5:00 PM.</strong>
            </small>
        </div>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Groom's Name</label>
        <input type="text" name="grooms_name" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->grooms_name : '' }}" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Grooms Birth Date</label>
        <input type="date" name="grooms_birth_date" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->grooms_birth_date : '' }}" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Bride's Name</label>
        <input type="text" name="brides_name" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->brides_name : '' }}" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Bride's Birth Date</label>
        <input type="date" name="brides_birth_date" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->brides_birth_date : '' }}" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        <label class="form-label">Matrimony Date</label>
        <input type="date" name="matrimony_date" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->matrimony_date : '' }}" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $matrimonyRequest->id ? $matrimonyRequest->contact_number : '' }}" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $matrimonyRequest->is_ready ? 'readonly' : 'required' }}>{{ $matrimonyRequest->address }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document in 3-5 business days. You'll recieve an email advisory when it's ready for pickup.
            </small>
        </div>
    </div>

</div>