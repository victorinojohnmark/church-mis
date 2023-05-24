@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            {{-- Content goes here --}}
        </div>
    </div>
</div>
@endsection