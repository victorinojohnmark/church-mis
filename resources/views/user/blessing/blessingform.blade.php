<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $blessing->created_by_id ?? Auth::id() }}">
    <input type="hidden" name="id" value="{{ $blessing->id ?? null }}">

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                <strong>Event Reservations is close on mondays.</strong>
            </small>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        @php
            $types = ['House', 'Business'];
        @endphp
        <label class="form-label">Type</label>
        <select name="blessing_type" class="form-control" required>
            @forelse ($types as $type)
                <option value="{{ $type }}" {{ $blessing->blessing_type == $type ? 'selected' : '' }}>{{ $type }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $blessing->name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" value="{{ old('date', $blessing->date ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" value="{{ old('time', $blessing->time ?? null) }}" class="form-control" placeholder="..." id="customTime" list="customTimes" required>

        <datalist id="customTimes">
            <option value="08:00">
            <option value="09:00">
            <option value="10:00">
            <option value="11:00">
            <option value="12:00">
            <option value="13:00">
            <option value="14:00">
            <option value="15:00">
            <option value="16:00">
        </datalist>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" cols="30" rows="5">{{ old('address', $blessing->address ?? null) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Landmark</label>
        <input type="text" name="landmark" value="{{ old('landmark', $blessing->landmark ?? null) }}" class="form-control" placeholder="...">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', $blessing->contact_number ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    
</div>