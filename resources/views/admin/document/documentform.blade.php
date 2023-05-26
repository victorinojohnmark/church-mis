@csrf
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <select name="user_id" class="form-control" required>
                <option selected disabled>Select here...</option>
                @forelse ($parishioners as $parishioner)
                <option value="{{ $parishioner->id }}">{{ $parishioner->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Document Type</label>
            <select name="document_type" class="form-control" required>
                <option selected disabled>Select here...</option>
                @forelse ($documentTypes as $documentType)
                <option value="{{ $documentType }}">{{ $documentType }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">File</label>
            <input type="file" name="filename" class="form-control" accept="image/*" required>
        </div>
    </div>
</div>