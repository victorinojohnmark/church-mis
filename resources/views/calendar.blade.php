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

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/calendar',
            eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                meridiem: true
            },
            dayMaxEventRows: true, // for all non-TimeGrid views
            views: {
                timeGrid: {
                dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            }
        })
        calendar.render()
      })
</script>
@endpush
