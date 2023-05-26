@extends('layouts.app')

@section('content')
<div class="p-0 mb-5">
  <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active"
              aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1"
              aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2"
              aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="carousel-content">
              <h3>Title Event</h3>
              <p class="w-50">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus alias temporibus laudantium dolor reprehenderit amet.</p>
              <a href="#" class="btn btn-primary">View</a>
            </div>
            <img src="/img/banner1.jpg" class="d-block w-100" alt="banner 1">
          </div>
          <div class="carousel-item active">
            <div class="carousel-content">
              <h3>Title Event</h3>
              <p class="w-50">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus alias temporibus laudantium dolor reprehenderit amet.</p>
              <a href="#" class="btn btn-primary">View</a>
            </div>
            <img src="/img/banner2.jpg" class="d-block w-100" alt="banner 1">
          </div>
          <div class="carousel-item active">
            <div class="carousel-content">
              <h3>Title Event</h3>
              <p class="w-50">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus alias temporibus laudantium dolor reprehenderit amet.</p>
              <a href="#" class="btn btn-primary">View</a>
            </div>
            <img src="/img/banner3.jpg" class="d-block w-100" alt="banner 1">
          </div>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>
</div>

<div id="featureWrapper">
  <div class="container">
    <div class="row gx-5 row-cols-1 row-cols-md-3 m-0">
        <div class="col mb-5 h-100 py-3">
            <div class="feature bg-secondary text-white rounded-3 mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
              </svg>                                   
            </div>
            <h2 class="h5 text-success">Events</h2>
            <p class="mb-3">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
            <a href="#">View Events</a>
          </div>
        <div class="col mb-5 h-100 py-3">
            <div class="feature bg-secondary text-white rounded-3 mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
              </svg>                      
            </div>
            <h2 class="h5 text-success">Request Document</h2>
            <p class="mb-3">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
            <a href="#">Submit a request</a>
        </div>

        <div class="col mb-5 h-100 py-3">
          <div class="feature bg-secondary text-white rounded-3 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>                                 
          </div>
          <h2 class="h5 text-success">Donate</h2>
          <p class="mb-3">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
          <a href="#">Give</a>
      </div>
    </div>
  </div>
</div>
@endsection

