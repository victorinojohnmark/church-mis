<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $baptismRequest->id ?? null }}">
    <input type="hidden" name="user_id" value="{{ $baptismRequest->user_id ?? Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{  $baptismRequest->requested_date ?? date('Y-m-d') }}">

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                <strong>The Church Office is closed on Mondays and opens from Tuesdays to Saturdays, 8:00 AM to 5:00 PM.</strong>
            </small>
        </div>
    </div>

    <div class="col-md-8">
        <label class="form-label">Name of the Baby</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ old('name', $baptismRequest->name ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        <label class="form-label">Baptismal Date</label>
        <input type="date" name="baptismal_date" class="form-control mb-3" value="{{ old('baptismal_date', $baptismRequest->baptismal_date ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ old('birth_date', $baptismRequest->birth_date ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Birth Place</label>
        <textarea name="birth_place" class="form-control" cols="30" rows="2">{{ old('birth_place', $baptismRequest->birth_place ?? null) }}</textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $baptismRequest && $baptismRequest->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $baptismRequest && $baptismRequest->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ old('contact_number', $baptismRequest->contact_number ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ old('father_name', $baptismRequest->father_name ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ old('birth_place', $baptismRequest->birth_place ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>{{ old('address', $baptismRequest->address ?? null) }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ old('purpose', $baptismRequest->purpose ?? null) }}" placeholder="..." {{ $baptismRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document within the day. You’ll receive an email advisory when it’s ready for pick up.
            </small>
        </div>
    </div>

</div>