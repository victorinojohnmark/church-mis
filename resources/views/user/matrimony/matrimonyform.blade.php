<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $matrimony->created_by_id }}">
    <input type="hidden" name="id" value="{{ $matrimony->id }}">
    <div class="col-md-6 mb-3">
        <label class="form-label">Groom's Name</label>
        <input type="text" name="grooms_name" value="{{ $matrimony->grooms_name }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Groom's Birth Date</label>
        <input type="date" name="grooms_birth_date" value="{{ $matrimony->grooms_birth_date }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bride's Name</label>
        <input type="text" name="brides_name" value="{{ $matrimony->brides_name }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bride's Birth Date</label>
        <input type="date" name="brides_birth_date" value="{{ $matrimony->brides_birth_date }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Matrimony Date</label>
        <input type="date" name="wedding_date" value="{{ $matrimony->wedding_date }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ $matrimony->contact_number }}" class="form-control" placeholder="..." required>
    </div>

    
</div>