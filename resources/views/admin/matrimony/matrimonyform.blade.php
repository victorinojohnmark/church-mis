<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $matrimony->created_by_id }}">
    <input type="hidden" name="id" value="{{ $matrimony->id }}">
    <div class="col-md-6 mb-3">
        <label class="form-label">Groom's Name</label>
        <input type="text" name="grooms_name" value="{{ $matrimony->grooms_name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Groom's Birth Date</label>
        <input type="date" name="grooms_birth_date" value="{{ $matrimony->grooms_birth_date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bride's Name</label>
        <input type="text" name="brides_name" value="{{ $matrimony->brides_name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Bride's Birth Date</label>
        <input type="date" name="brides_birth_date" value="{{ $matrimony->brides_birth_date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Wedding Date</label>
        <input type="date" name="wedding_date" value="{{ $matrimony->wedding_date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" value="{{ old('time', $matrimony->time ?? null) }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control" onchange="toggleRelationshipDetail()" disabled>
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $relationship = ['Mother', 'Father', 'Spouse', 'Other']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $matrimony && $matrimony->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    
    @if ($matrimony->other_relationship)
    <div class="col-md-4 mb-3">
        <label class="form-label">&nbsp;</label>
        <input type="text" name="other_relationship" id="other_relationship" value="{{ old('other_relationship', $matrimony->other_relationship ?? null) }}" class="form-control" placeholder="Relationship Detail" readonly>
    </div>
    @endif

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ $matrimony->contact_number }}" class="form-control" placeholder="..." readonly>
    </div>

    
</div>