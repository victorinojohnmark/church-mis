<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $funeral->created_by_id }}">
    <input type="hidden" name="id" value="{{ $funeral->id }}">

    <div class="col-md-6 mb-3">
        <label class="form-label">Date of Mass</label>
        <input type="date" name="date" value="{{ $funeral->date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Time</label>
        <input type="time" name="time" value="{{ $funeral->time }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $funeral->name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Age</label>
        <input type="number" name="age" value="{{ $funeral->age }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        @php
            $statuses = ['Single', 'Married'];
        @endphp
        <label class="form-label">Status</label>
        <select name="status" class="form-control" readonly>
            @forelse ($statuses as $status)
                <option value="{{ $status }}" {{ $funeral->status == $status ? 'selected' : '' }}>{{ $status }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control" readonly disabled>
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $funeral && $funeral->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control" readonly disabled>
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $funeral && $funeral->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    

    {{-- <div class="col-md-6 mb-3">
        <label class="form-label">Religion</label>
        <input type="text" name="religion" value="{{ $funeral->religion }}" class="form-control" placeholder="..." readonly>
    </div> --}}

    <div class="col-md-12 mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" cols="30" rows="5" readonly>{{ $funeral->address }}</textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Date of Death</label>
        <input type="date" name="date_of_death" value="{{ $funeral->date_of_death }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Cause of Death</label>
        <input type="string" name="cause_of_death" value="{{ $funeral->cause_of_death }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Cemetery</label>
        <input type="text" name="cemetery" value="{{ $funeral->cemetery }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Funeraria</label>
        <input type="text" name="funeraria" value="{{ $funeral->funeraria }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Person</label>
        <input type="text" name="contact_person" value="{{ $funeral->contact_person }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" value="{{ $funeral->contact_number }}" class="form-control" placeholder="..." readonly>
    </div>

    
</div>