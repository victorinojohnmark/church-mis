@extends('layouts.admin')

@section('title', $event->title)

@section('content')
<div class="py-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createEventModal">Update</button>
    <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="createEventModalLabel">Event Post</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <form action="{{ route('eventsave') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @include('admin.event.eventform')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    
          </div>
        </div>
    </div>
</div>

<div class="py-3">
    <img src="{{ '/storage/event-banners/' . $event->banner_image }}" class="img-fluid" alt="banner">
</div>

<div id="eventBody" class="py-3 mb-3">
    {!! $event->body !!}
</div>

<a href="{{ route('admin-eventlist') }}" class="btn btn-success mb-3">Back to Event List</a>

@endsection


@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap5.min.js"></script>
    <script src="/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#events-table').DataTable({

            });

            
            
        });

        tinymce.init({
            selector: '#tinyMCE'
        });

        

    </script>
@endpush
