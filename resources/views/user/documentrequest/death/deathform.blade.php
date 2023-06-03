<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $deathRequest->id ? $deathRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $deathRequest->id ? $deathRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $deathRequest->id ? $deathRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->name : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Date of Death</label>
        <input type="date" name="date_of_death" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->date_of_death : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Cause of Death</label>
        <input type="text" name="cause_of_death" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->cause_of_death : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        <label class="form-label">Age</label>
        <input type="number" name="age" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->age : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-4">
        @php
            $statuses = ['Single', 'Married'];
        @endphp
        <label class="form-label">Status</label>
        <select name="status" class="form-control" {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
            @forelse ($statuses as $status)
                <option value="{{ $status }}" {{ $deathRequest->status == $status ? 'selected' : '' }}>{{ $status }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Religion</label>
        <input type="text" name="religion" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->religion : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Person</label>
        <input type="text" name="contact_person" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->contact_person : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->contact_number : '' }}" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>
    </div>

    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." {{ $deathRequest->is_ready ? 'readonly' : 'required' }}>{{ $deathRequest->address }}</textarea>
    </div>

    <div class="col-md-12">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                You might receive the document in 3-5 business days. You'll recieve an email advisory when it's ready for pickup.
            </small>
        </div>
    </div>

</div>