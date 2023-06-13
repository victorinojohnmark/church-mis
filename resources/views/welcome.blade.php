@extends('layouts.app')

@section('content')

<div id="homeBannerWrapper" class="w-100" style="height: 400px;">
  <div class="container d-flex align-items-end" style="height: 400px;">
    <h1 class="font-inter text-white fs-1 fw-bold pb-3">SAINT GREGORY <br> THE GREAT PARISH CHURCH</h1>
  </div>
  <img src="/img/saint_gregory.png" class="img-fluid z-n1 position-absolute top-0 object-fit-cover w-100 mt-5" style="height: 400px; object-position: 80% 50%;">
</div>

<div id="eventsWrapper" class="py-3">
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
            
        @endforelse
      </div>
    </div>
  </div>
</div>


{{-- <div class="container">
    <div class="row mt-3">
        <div class="col-md-8 py-3">
            <h2 class="d-inline">Events</h2>
            <a href="{{ route('eventlist') }}" class="btn btn-success btn-sm float-end">View more Events</a>
            <hr>
            @forelse ($events as $event)
              <div class="row event-items p-3 py-4">
                <div class="col-md-2 dateWrapper">
                  <div class="overflow-hidden w-100" style="max-width: 100px;">
                    <h4 class="bg-success text-center text-white p-3 mb-0 rounded-top">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</h4>
                    <span class="d-block bg-white p-3 text-center text-dark w-100 rounded-bottom border border-1 border-dark border-top-0 fs-5 fw-semibold">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                  </div>
                </div>

                <div class="col-md-10">
                  <div class="imageWrapper overflow-hidden w-100 mb-3" style="max-height: 400px;">
                    <img src="{{ '/storage/event-banners/' . $event->banner_image }}" class="img-fluid" alt="banner">
                  </div>
                  <h5 class="fw-bold">{!! $event->title !!}</h5>
                  <small class="event-date text-secondary">Date of Event: {{ $event->event_date }}</small>
                  <p class="card-text ms-1 mb-1 fs-6 fw-normal">{!! $event->body_excerpt !!} <a href="{{ route('eventshow', ['event' => $event->id]) }}" class="d-inline">Read more</a></p>
                  

                </div>
              </div>
            @empty
                <p>No event postings yet</p>
            @endforelse

        </div>

        <div class="col-md-4 py-3">
            <div class="">
              <div class="card mb-3 rounded-0">
                <div class="mb-3">
                    <div class="card-body">
                        <h5 class="card-title ms-1">Document Request</h5>
                        <p class="card-text ms-1">Request your document with a simple form and recieve notifications when its ready</p>
                        <a href="{{ route('client-documentrequestlist') }}" class="btn btn-warning mt-1">Submit a request</a>
                    </div>
                </div>
            </div>

            <div class="card rounded-0">
                <div class="mb-3">
                    <div class="card-body">
                        <h5 class="card-title ms-1">Event Reservation</h5>
                        <p class="card-text ms-1">Reservation of events like Baptism, Confirmation, Communion and etc.</p>
                        <a href="{{ route('clientreservations') }}" class="btn btn-warning mt-1">Create reservation</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

