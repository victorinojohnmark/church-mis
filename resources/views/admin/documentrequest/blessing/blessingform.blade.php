<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $blessingRequest->id ? $blessingRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $blessingRequest->id ? $blessingRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $blessingRequest->id ? $blessingRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $blessingRequest->id ? $blessingRequest->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        @php
            $types = ['House', 'Apartment', 'Business', 'Car'];
        @endphp
        <label class="form-label">Type</label>
        <select name="blessing_type" class="form-control mb-3" readonly disabled>
            @forelse ($types as $type)
                <option value="{{ $type }}" {{ $blessingRequest->blessing_type == $type ? 'selected' : '' }}>{{ $type }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Blessing Date</label>
        <input type="date" name="blessing_date" class="form-control mb-3" value="{{ $blessingRequest->id ? $blessingRequest->blessing_date : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $blessingRequest->id ? $blessingRequest->contact_number : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." readonly>{{ $blessingRequest->address }}</textarea>
    </div>

</div>