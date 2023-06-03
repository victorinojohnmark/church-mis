<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $blessingRequest->id ? $blessingRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $blessingRequest->id ? $blessingRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $blessingRequest->id ? $blessingRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $blessingRequest->id ? $blessingRequest->name : '' }}" placeholder="..." {{ $blessingRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        @php
            $types = ['House', 'Apartment', 'Business', 'Car'];
        @endphp
        <label class="form-label">Type</label>
        <select name="blessing_type" class="form-control mb-3" {{ $blessingRequest->is_ready ? 'readonly' : 'required' }}>
            @forelse ($types as $type)
                <option value="{{ $type }}" {{ $blessingRequest->blessing_type == $type ? 'selected' : '' }}>{{ $type }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Blessing Date</label>
        <input type="date" name="blessing_date" class="form-control mb-3" value="{{ $blessingRequest->id ? $blessingRequest->blessing_date : '' }}" placeholder="..." {{ $blessingRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $blessingRequest->id ? $blessingRequest->contact_number : '' }}" placeholder="..." {{ $blessingRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $blessingRequest->is_ready ? 'readonly' : 'required' }}>{{ $blessingRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document in 3-5 business days. You'll recieve an email advisory when it's ready for pickup.
            </small>
        </div>
    </div>

</div>