@extends('layouts.admin')

@section('title', 'Calendar')

@section('content')
<div class="container">
    <div class="p-3">
      <div id='calendar' class="bg-body-secondary p-3 mb-3"></div>
        <ul class="list-group col-md-4">
            <li class="list-group-item"><span class="red">&#8226;</span> <span class="font-weight-bold">Baptism</span></li>
            <li class="list-group-item"><span class="green">&#8226;</span> <span class="font-weight-bold">Blessing</span></li>
            <li class="list-group-item"><span class="blue">&#8226;</span> <span class="font-weight-bold">Communion</span></li>
            <li class="list-group-item"><span class="orange">&#8226;</span> <span class="font-weight-bold">Confirmation</span></li>
            <li class="list-group-item"><span class="skyblue">&#8226;</span> <span class="font-weight-bold">Funeral</span></li>
            <li class="list-group-item"><span class="violet">&#8226;</span> <span class="font-weight-bold">Wedding</span></li>
        </ul>
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