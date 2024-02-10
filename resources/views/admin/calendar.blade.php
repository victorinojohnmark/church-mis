@extends('layouts.admin')

@section('title', 'Calendar')

@section('content')
<div class="container">
    <div class="p-3">
        <div class="row">
            <div id='calendar' class="mb-3 col-md-12"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<script>
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
</script>
@endpush