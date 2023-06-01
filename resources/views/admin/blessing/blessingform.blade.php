<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $blessing->created_by_id }}">
    <input type="hidden" name="id" value="{{ $blessing->id }}">

    <div class="col-md-12 mb-3">
        @php
            $types = ['House', 'Apartment', 'Business', 'Car'];
        @endphp
        <label class="form-label">Type</label>
        <select name="blessing_type" class="form-control" readonly>
            @forelse ($types as $type)
                <option value="{{ $type }}" {{ $blessing->blessing_type == $type ? 'selected' : '' }}>{{ $type }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $blessing->name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" value="{{ $blessing->date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" value="{{ $blessing->time }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Religion</label>
        <input type="text" name="religion" value="{{ $blessing->religion }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" cols="30" rows="5" readonly>{{ $blessing->address }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Landmark</label>
        <input type="text" name="landmark" value="{{ $blessing->landmark }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ $blessing->contact_number }}" class="form-control" placeholder="..." readonly>
    </div>

    
</div>