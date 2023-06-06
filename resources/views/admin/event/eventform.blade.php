<div class="row">
    @csrf
    <input type="hidden" name="id" value="{{ $event->id ? $event->id : '' }}">
    <input type="hidden" name="user_id" value="{{ $event->id ? $event->user_id : Auth::id() }}">
    <div class="col-md-12 mb-3">
        <label class="form-label">Event Title</label>
        <input type="text" name="title" class="form-control" value="{{ $event->id ? $event->title : '' }}">
    </div>

    <div class="col-md-8 mb-3">
        <label class="form-label">Banner Image</label>
        <input type="file" name="banner_image" class="form-control mb-3" accept="image/*" value="{{ $event->id ? $event->title : '' }}">
        <div class="p-3 bg-body-secondary rounded">
            <small><i class="fa-solid fa-circle-info text-primary"></i>
                For optimal result, Banner image should be in 1257px width and 400px height.
            </small>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Event Date</label>
        <input type="date" name="event_date" class="form-control mb-3" value="{{ $event->id ? $event->event_date : '' }}">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Body</label>
        <textarea name="body" id="tinyMCE" cols="30" rows="10">{{ $event->id ? $event->body : '' }}</textarea>
    </div>
</div>