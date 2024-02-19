<div class="row">
    {{-- @csrf
    <input type="hidden" name="created_by_id" value="{{ $communion->created_by_id ?? Auth::id() }}">
    <input type="hidden" name="id" value="{{ $communion->id ?? null }}">
    <div class="col-md-12 mb-3">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                <strong>Only the catechist can reserve and upload file.</strong>
            </small>
        </div>
    </div>
    
    <div class="col-md-12 mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $communion->name ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Contact #</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', $communion->contact_number ?? null) }}" class="form-control" placeholder="..." required>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Present Address</label>
        <textarea name="present_address" class="form-control" cols="30" rows="5" required>{{ old('present_address', $communion->present_address ?? null) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <a href="/forms/first-communion-format.xlsx" class="btn btn-success btn-sm">Download Form</a>
    </div>

    <div class="col-md-12 mb-3">
        <label for="inputFile">Upload File</label><br>
        <input type="file" name="file" class="form-control-file" id="inputFile" accept=".xls, .xlsx, .csv" required>
        @if ($communion->file)
        <a href="/storage/{{ $communion->file }}">Download File</a>
        @endif
    </div> --}}

    
</div>