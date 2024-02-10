@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Calendar</h1>
                <hr>
                <div class="row">
                    <reservation-calendar></reservation-calendar>
                    {{-- <div id='calendar' class="mb-3 col-md-12"></div> --}}
                    {{-- <div class="col-md-2">
                        <ul class="list-group">
                            <li class="list-group-item"><span class="red">&#8226;</span> <span class="font-weight-bold">Baptism</span></li>
                            <li class="list-group-item"><span class="green">&#8226;</span> <span class="font-weight-bold">Blessing</span></li>
                            <li class="list-group-item"><span class="blue">&#8226;</span> <span class="font-weight-bold">Communion</span></li>
                            <li class="list-group-item"><span class="orange">&#8226;</span> <span class="font-weight-bold">Confirmation</span></li>
                            <li class="list-group-item"><span class="skyblue">&#8226;</span> <span class="font-weight-bold">Funeral</span></li>
                            <li class="list-group-item"><span class="violet">&#8226;</span> <span class="font-weight-bold">Wedding</span></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
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
</script> --}}
@endpush
