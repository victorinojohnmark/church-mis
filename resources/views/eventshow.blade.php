@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12 py-3">
            <h2 class="d-inline">{!! $event->title !!}</h2>
            <hr>
            <div class="py-3">
                <img src="{{ '/storage/event-banners/' . $event->banner_image }}" class="img-fluid" alt="banner">
            </div>
            
            <div id="eventBody" class="py-3 mb-3">
                {!! $event->body !!}
            </div>
            
            <a href="{{ route('eventlist') }}" class="btn btn-success mb-3">View Event List</a>

        </div>
    </div>

</div>

@endsection