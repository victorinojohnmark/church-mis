<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $funeral->created_by_id ?? Auth::id() }}">
    <input type="hidden" name="id" value="{{ $funeral->id ?? null }}">

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i> &nbsp;
                <strong>Event Reservations is close on mondays.</strong>
            </small>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $funeral->name ?? null) }}" class="form-control" placeholder="..." required>
        @error('name')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" value="{{ old('date', $funeral->date ?? null) }}" class="form-control" placeholder="..." required>
        @error('date')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <select name="time" id="time" class="form-control" required>
            <option disabled="" value="">Select here...</option>
            <option value="13:00" {{ old('time', $funeral->time) == "13:00" ? 'selected' : '' }}>1:00PM</option>
            <option value="14:00" {{ old('time', $funeral->time) == "14:00" ? 'selected' : '' }}>2:00PM</option>
            <option value="15:00" {{ old('time', $funeral->time) == "15:00" ? 'selected' : '' }}>3:00PM</option>
        </select>
        <small>Available Time: 1:00PM, 2:00 PM, 3:00 PM</small>
        @error('time')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Age</label>
        <input type="number" name="age" min="1" value="{{ old('age', $funeral->age ?? null) }}" class="form-control" placeholder="..." required>
        @error('age')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $funeral && $funeral->sex == $item ? 'selected' : '' }} {{ old('sex', $funeral->sex) == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
        @error('sex')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        @php
            $statuses = ['Single', 'Married'];
        @endphp
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            @forelse ($statuses as $status)
                <option value="{{ $status }}" {{ $funeral->status == $status ? 'selected' : '' }} {{ old('status', $funeral->status) == $item ? 'selected' : '' }}>{{ $status }}</option>
            @empty
                
            @endforelse
        </select>
        @error('other_relationship')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control" onchange="toggleRelationshipDetail()">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling', 'Other']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $funeral && $funeral->relationship == $item ? 'selected' : '' }} {{ old('relationship', $funeral->relationship) == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
        @error('relationship')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <div class="col-md-4 mb-3">
        <label class="form-label">&nbsp;</label>
        <input type="text" name="other_relationship" id="other_relationship" value="{{ old('other_relationship', $funeral->other_relationship ?? null) }}" class="form-control" placeholder="Relationship Detail" {{ $funeral && $funeral->relationship !== 'Other' ? 'disabled' : '' }} {{ $funeral && $funeral->relationship === 'Other' ? 'required' : '' }}>
        @error('other_relationship')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    

    <div class="col-md-12 mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" cols="30" rows="5">{{ old('address', $funeral->address ?? null) }}</textarea>
        @error('address')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Date of Death</label>
        <input type="date" name="date_of_death" value="{{ old('date_of_death', $funeral->date_of_death ?? null) }}" class="form-control" placeholder="..." required>
        @error('date_of_death')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Cause of Death</label>
        <input type="string" name="cause_of_death" value="{{ old('cause_of_death', $funeral->cause_of_death ?? null) }}" class="form-control" placeholder="..." required>
        @error('cause_of_death')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Cemetery</label>
        <input type="text" name="cemetery" value="{{ old('cemetery', $funeral->cemetery ?? null) }}" class="form-control" placeholder="..." required>
        @error('cemetery')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Funeraria</label>
        <input type="text" name="funeraria" value="{{ old('funeraria', $funeral->funeraria ?? null) }}" class="form-control" placeholder="..." required>
        @error('funeraria')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Person</label>
        <input type="text" name="contact_person" value="{{ old('contact_person', $funeral->contact_person ?? null) }}" class="form-control" placeholder="..." required>
        @error('contact_person')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', $funeral->contact_number ?? null) }}" class="form-control" placeholder="..." required>
        @error('contact_number')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    
</div>