@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-8 py-3">
            <h2>Events</h2>
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
                
            @endforelse

            {{-- <div class="row event-items p-3 " style="">
              <div class="col-md-2 dateWrapper">
                <div class="overflow-hidden w-100" style="max-width: 100px;">
                  <h4 class="bg-success text-center text-white p-3 mb-0 rounded-top">FEB</h4>
                  <span class="d-block bg-white p-3 text-center text-dark w-100 rounded-bottom border border-1 border-dark border-top-0 fs-5 fw-semibold">27</span>
                </div>
              </div>

              <div class="col-md-10">
                <img src="/img/banner1.jpg" class="img-fluid mb-3">
                <h3>Suicide Squad</h3>
                <p class="card-text ms-1">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.
                  Paragraph of text beneath the heading to explain the heading. Here is just a bit more text. <a href="#" class="d-inline">Read more</a>
                </p>

              </div>
            </div>

            <div class="row event-items p-3 " style="">
              <div class="col-md-2 dateWrapper">
                <div class="overflow-hidden w-100" style="max-width: 100px;">
                  <h4 class="bg-success text-center text-white p-3 mb-0 rounded-top">FEB</h4>
                  <span class="d-block bg-white p-3 text-center text-dark w-100 rounded-bottom border border-1 border-dark border-top-0 fs-5 fw-semibold">27</span>
                </div>
              </div>

              <div class="col-md-10">
                <img src="/img/banner1.jpg" class="img-fluid mb-3">
                <h3>Suicide Squad</h3>
                <p class="card-text ms-1">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.
                  Paragraph of text beneath the heading to explain the heading. Here is just a bit more text. <a href="#" class="d-inline">Read more</a>
                </p>

              </div>
            </div> --}}
        </div>

        <div class="col-md-4 py-3">
            <div class="pt-3">
              <div class="card mb-3 rounded-0">
                <div class="mb-3">
                    <div class="card-body">
                        <h5 class="card-title ms-1">Document Request</h5>
                        <p class="card-text ms-1">Paragraph of text beneath the heading to explain the heading. Here is
                            just
                            a bit more text.</p>
                        <a href="{{ route('client-documentrequestlist') }}" class="btn btn-warning mt-1">Submit a request</a>
                    </div>
                </div>
            </div>

            <div class="card rounded-0">
                <div class="mb-3">
                    <div class="card-body">
                        <h5 class="card-title ms-1">Event Reservation</h5>
                        <p class="card-text ms-1">Paragraph of text beneath the heading to explain the heading. Here is
                            just
                            a bit more text.</p>
                        <a href="{{ route('clientreservations') }}" class="btn btn-warning mt-1">Create reservation</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

