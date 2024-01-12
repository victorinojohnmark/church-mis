<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $baptism->created_by_id ?? Auth::id() }}">
    <input type="hidden" name="id" value="{{ $baptism->id ?? null }}">
    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                Sundays at 10am for Regular reservation and Tuesday to Saturday 8-5pm for special schedules.
                <strong>Church Office and Event Reservation is close on mondays.</strong>
            </small>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Name of the Baby</label>
        <input type="text" name="name" value="{{ old('name', $baptism->name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control">
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $baptism && $baptism->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control">
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $baptism && $baptism->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Desired Date</label>
        <input type="date" name="date" value="{{ old('date', $baptism->date ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" value="{{ old('time', $baptism->time ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Place of Birth</label>
        <textarea name="place_of_birth" class="form-control" cols="30" rows="2">{{ old('place_of_birth', $baptism->place_of_birth ?? null) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-group form-check">
            <input type="checkbox" name="is_special" class="form-check-input" {{ $baptism && $baptism->is_special ? 'checked' : '' }}>
            <label class="form-check-label">Special Schedule</label>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" value="{{ old('birth_date', $baptism->birth_date ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Father's Name</label>
        <input type="text" name="fathers_name" value="{{ old('fathers_name', $baptism->fathers_name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mothers_name" value="{{ old('mothers_name', $baptism->mothers_name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact #</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', $baptism->contact_number ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Present Address</label>
        <textarea name="present_address" class="form-control" cols="30" rows="2">{{ old('present_address', $baptism->present_address ?? null) }}</textarea>
    </div>
</div>