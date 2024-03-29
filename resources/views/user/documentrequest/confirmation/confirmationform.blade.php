<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $confirmationRequest->id ? $confirmationRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $confirmationRequest->id ? $confirmationRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $confirmationRequest->id ? $confirmationRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i> &nbsp;
                <strong>The Church Office is closed on Mondays and opens from Tuesdays to Saturdays, 8:00 AM to 5:00 PM.</strong>
            </small>
        </div>
    </div>

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ old('name', $confirmationRequest->name ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('name')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Confirmation Date</label>
        <input type="date" name="confirmation_date" class="form-control mb-3" value="{{ old('confirmation_date', $confirmationRequest->confirmation_date ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('confirmation_date')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ old('birth_date', $confirmationRequest->birth_date ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('birth_date')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ old('contact_number', $confirmationRequest->contact_number ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('contact_number')
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
                <option {{ $confirmationRequest && $confirmationRequest->sex == $item ? 'selected' : '' }} {{ old('sex', $confirmationRequest->sex) == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
        @error('sex')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling', 'Myself']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $confirmationRequest && $confirmationRequest->relationship == $item ? 'selected' : '' }} {{ old('relationship', $confirmationRequest->relationship) == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
        @error('relationship')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ old('father_name', $confirmationRequest->father_name ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('father_name')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ old('mother_name', $confirmationRequest->mother_name ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('mother_name')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>{{ old('address', $confirmationRequest->address ?? null) }}</textarea>
        @error('address')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ old('purpose', $confirmationRequest->purpose ?? null) }}" placeholder="..." {{ $confirmationRequest->is_ready ? 'readonly' : 'required' }}>
        @error('purpose')
            <span class="invalid-feedback d-block text-left" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document within the day. You’ll receive an email advisory when it’s ready for pick up.
            </small>
        </div>
    </div> --}}

</div>