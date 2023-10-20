@extends('layouts.app')

@section('content')

<div class="py-3">
    <div id="eventsWrapper">
        <div class="container bg-body-secondary">
          <div class="p-3">
            <h3 class="text-center">Announcements</h3>
            <div class="row">
              @forelse ($events as $event)
              <div class="col-md-4 py-3">
                <div class="eventCard position-relative">
                  <div class="bannerCard">
                    <img src="{{ '/storage/event-banners/' . $event->banner_image }}" class="img-fluid" alt="">
                    <div class="dateCard d-flex flex-column z-1 position-absolute top-0" style="width: 55px;">
                      <div class="date w-100 d-flex justify-content-center align-items-center text-center" style="height: 55px;">
                        <span class="fs-4 fw-semibold text-white">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                      </div>
                      <div class="month w-100 d-flex flex-column justify-content-center align-items-center text-center" style="height: 55px;">
                        <span class="fs-5 fw-semibold text-white">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                        <span class="fs-6 fw-semibold text-white">{{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}</span>
                      </div>
                    </div>
                  </div>
      
                  <div class="contextCard bg-white p-4">
                    <h3 class="fs-3">{!! $event->title !!}</h3>
                    <p>{!! $event->body_excerpt !!}</p>
                    <a href="{{ route('eventshow', ['event' => $event->id]) }}" class="btn btn-warning rounded-pill text-white px-5 text-center mx-auto d-table w-auto">Read More</a>
                    
                  </div>
                </div>
              </div>
              
              @empty
              <p>No event posting yet. </p> 
              @endforelse
            </div>
          </div>
        </div>
      </div>
</div>

@endsection