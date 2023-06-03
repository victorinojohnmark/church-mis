<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $deathRequest->id ? $deathRequest->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $deathRequest->id ? $deathRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $deathRequest->id ? $deathRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Date of Death</label>
        <input type="date" name="date_of_death" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->date_of_death : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Cause of Death</label>
        <input type="text" name="cause_of_death" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->cause_of_death : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-4">
        <label class="form-label">Age</label>
        <input type="number" name="age" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->age : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-4">
        @php
            $statuses = ['Single', 'Married'];
        @endphp
        <label class="form-label">Status</label>
        <select name="status" class="form-control" readonly disabled>
            @forelse ($statuses as $status)
                <option value="{{ $status }}" {{ $deathRequest->status == $status ? 'selected' : '' }}>{{ $status }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Religion</label>
        <input type="text" name="religion" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->religion : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <hr>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Person</label>
        <input type="text" name="contact_person" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->contact_person : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control mb-3" value="{{ $deathRequest->id ? $deathRequest->contact_number : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <label class="form-label">Address</label>
        <textarea name="address" cols="30" rows="3" class="form-control mb-3" placeholder="..." readonly>{{ $deathRequest->address }}</textarea>
    </div>

</div>