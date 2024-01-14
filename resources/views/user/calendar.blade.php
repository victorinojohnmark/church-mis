@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Calendar</h1>
                <hr>
                <div id='calendar' class="mb-3"></div>
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