<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $matrimony->created_by_id ?? Auth::id() }}">
    <input type="hidden" name="id" value="{{ $matrimony->id ?? null }}">
    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                <strong>Event Reservations are closed on Mondays.</strong>
            </small>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Groom's Name</label>
        <input type="text" name="grooms_name" value="{{ old('grooms_name', $matrimony->grooms_name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Groom's Birth Date</label>
        <input type="date" name="grooms_birth_date" value="{{ old('grooms_birth_date', $matrimony->grooms_birth_date ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bride's Name</label>
        <input type="text" name="brides_name" value="{{ old('brides_name', $matrimony->brides_name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bride's Birth Date</label>
        <input type="date" name="brides_birth_date" value="{{ old('brides_birth_date', $matrimony->brides_birth_date ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Wedding Date</label>
        <input type="date" name="wedding_date" value="{{ old('wedding_date', $matrimony->wedding_date ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" value="{{ old('time', $matrimony->time ?? null) }}" class="form-control" placeholder="..." required>
        <small>Available Time: 7:30 AM, 9:00 AM, 10:30 AM and 4:00 PM</small>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', $matrimony->contact_number ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    
</div>