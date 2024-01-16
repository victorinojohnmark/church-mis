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

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<style>
    .red { color: #FF0000; }
    .green { color: #00FF00; }
    .blue { color: #0000FF; }
    .orange { color: #FFA500; }
    .skyblue { color: #87CEEB; }
    .violet { color: #EE82EE; }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>
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
            timeFormat: 'hh(:mm) A'
            // eventRender: function (event, element) {
            //     // Extract the time from the "fc-time" span
            //     var eventTime = element.find('.fc-time').text();

            //     // Format the time using Moment.js with 'hh:mm A'
            //     var adjustedTime = moment(eventTime, 'h:mma').format('hh:mm A');

            //     // Replace the time in the event title
            //     element.find('.fc-title').html(event.title.replace(/\d{1,2}:\d{2}[aApP]+/, adjustedTime));
            // }
        });
    });
</script>

@endpush