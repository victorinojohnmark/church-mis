<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $communionRequest->id ? $communionRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $communionRequest->id ? $communionRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $communionRequest->id ? $communionRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-8">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->name : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        <label class="form-label">Communion Date</label>
        <input type="date" name="communion_date" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->baptismal_date : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->birth_date : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->contact_number : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control">
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
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling']
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
        <input type="text" name="father_name" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->father_name : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mother_name" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->mother_name : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Present Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>{{ $communionRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Purpose</label>
        <input type="text" name="purpose" class="form-control mb-3" value="{{ $communionRequest->id ? $communionRequest->purpose : '' }}" placeholder="..." {{ $communionRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document in 3-5 business days. You'll recieve an email advisory when it's ready for pickup.
            </small>
        </div>
    </div>

</div>