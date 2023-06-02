<div class="row">
    @csrf
    <input type="hidden" name="user_id" value="{{ $documentRequest->id ? $documentRequest->user_id : Auth::id() }}">
    <input type="hidden" name="requested_date" value="{{ $documentRequest->id ? $documentRequest->requested_date : date('Y-m-d') }}">

    <div class="col-md-12">
        <label class="form-label">Requested by</label>
        <input type="text" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->createdBy->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Document Type</label>
            <select name="document_type" class="form-control" readonly disabled>
                <option selected disabled>Select here...</option>
                @forelse ($documentTypes as $documentType)
                <option value="{{ $documentType }}" {{ $documentRequest->id && $documentRequest->document_type == $documentType ? 'selected' : ''  }}>{{ $documentType }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->name : '' }}" placeholder="..." readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Date Submitted</label>
        <input type="date" class="form-control mb-3" value="{{ $documentRequest->id ? $documentRequest->requested_date : '' }}" placeholder="..." readonly>
    </div>

</div>