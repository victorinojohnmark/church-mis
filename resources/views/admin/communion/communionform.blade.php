<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $communion->created_by_id }}">
    <input type="hidden" name="id" value="{{ $communion->id }}">
    <div class="col-md-12 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $communion->name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Desired Date</label>
        <input type="date" name="date" value="{{ $communion->date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" value="{{ $communion->birth_date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control" readonly disabled>
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $communion && $communion->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
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
                <option {{ $communion && $communion->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Father's Name</label>
        <input type="text" name="fathers_name" value="{{ $communion->fathers_name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mothers_name" value="{{ $communion->mothers_name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact #</label>
        <input type="text" name="contact_number" value="{{ $communion->contact_number }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Present Address</label>
        <textarea name="present_address" class="form-control" cols="30" rows="5" readonly>{{ $communion->present_address }}</textarea>
    </div>
</div>