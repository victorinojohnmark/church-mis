<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $communionRequest->id ?? null }}">
    <input type="hidden" name="user_id" value="{{ $communionRequest->user_id ?? Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $communionRequest->requested_date ?? date('Y-m-d') }}">

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ old('name', $communionRequest->name ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        <label class="form-label">Communion Date</label>
        <input type="date" name="communion_date" class="form-control mb-3" value="{{ old('communion_date', $communionRequest->communion_date ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ old('birth_date', $communionRequest->birth_date ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ old('contact_number', $communionRequest->contact_number ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $communionRequest && $communionRequest->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control">
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling', 'Myself']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $communionRequest && $communionRequest->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" name="father_name" class="form-control mb-3" value="{{ old('father_name', $communionRequest->father_name ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ old('mother_name', $communionRequest->mother_name ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>{{ old('address', $communionRequest->address ?? null) }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ old('purpose', $communionRequest->purpose ?? null) }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    {{-- <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document within the day. You’ll receive an email advisory when it’s ready for pick up.
            </small>
        </div>
    </div> --}}

</div>