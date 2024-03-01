<div class="row">
    @csrf
    <input type="hidden" name="created_by_id" value="{{ $baptism->created_by_id }}">
    <input type="hidden" name="id" value="{{ $baptism->id }}">
    <div class="col-md-12 mb-3">
        <label class="form-label">Name of the Baby</label>
        <input type="text" name="name" value="{{ $baptism->name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Desired Date</label>
        <input type="date" name="date" value="{{ $baptism->date }}" min="<?= date('Y-m-d'); ?>" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" value="{{ $baptism->birth_date }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Sex</label>
        <select name="sex" id="sex" class="form-control" readonly disabled>
            @php
                $sex = ['Male', 'Female']
            @endphp
            @forelse ($sex as $item)
                <option {{ $baptism && $baptism->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Relationship</label>
        <select name="relationship" id="relationship" class="form-control" onchange="toggleRelationshipDetail()" readonyl  disabled>
            <option value="{{ null }}" disabled selected>Select here...</option>
            @php
                $relationship = ['Grandmother', 'Grandfather', 'Mother', 'Father', 'Sibling', 'Other']
            @endphp
            @forelse ($relationship as $item)
                <option {{ $baptism && $baptism->relationship == $item ? 'selected' : '' }}>{{ $item }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    
    @if ($baptism->other_relationship)
    <div class="col-md-4 mb-3">
        <label class="form-label">&nbsp;</label>
        <input type="text" name="other_relationship" id="other_relationship" value="{{ old('other_relationship', $baptism->other_relationship ?? null) }}" class="form-control" placeholder="Relationship Detail" {{ $baptism && $baptism->relationship === 'Other' ? 'required' : '' }} disabled>
    </div>
    @endif

    <div class="col-md-6 mb-3">
        <label class="form-label">Father's Name</label>
        <input type="text" name="fathers_name" value="{{ $baptism->fathers_name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Mother's Name</label>
        <input type="text" name="mothers_name" value="{{ $baptism->mothers_name }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sponsor 1</label>
        <input type="text" name="sponsor_1" value="{{ $baptism->sponsor_1 }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Sponsor 2</label>
        <input type="text" name="sponsor_2" value="{{ $baptism->sponsor_2 }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact #</label>
        <input type="text" name="contact_number" value="{{ $baptism->contact_number }}" class="form-control" placeholder="..." readonly>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Present Address</label>
        <textarea name="present_address" class="form-control" cols="30" rows="5" readonly>{{ $baptism->present_address }}</textarea>
    </div>
</div>