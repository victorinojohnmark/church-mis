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
      <h3 class="text-center">Calendar</h3>
      <div id='calendar'></div>
    </div>
  </div>
</div>

@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script>
    $(document).ready(function () {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/calendar',
            selectable:true,
            selectHelper: true,
            editable:false,
            
            
            
        });
    });
    </script>

@endpush
