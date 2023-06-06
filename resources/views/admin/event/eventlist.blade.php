@extends('layouts.admin')

@section('title', 'Events Posting')

@section('content')
<div class="py-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createEventModal">Create Event</button>
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
<div class="table-responsive">
    <table id="events-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Event Date</th>
                <th>Created at</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{!! $event->title !!}</td>
                    <td>{!! $event->event_date !!}</td>
                    <td>{!! $event->created_at->format('Y-m-d') !!}</td>
                    <td>
                        <a href="{{ route('admin-eventshow', ['event' => $event->id]) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
</div>

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
