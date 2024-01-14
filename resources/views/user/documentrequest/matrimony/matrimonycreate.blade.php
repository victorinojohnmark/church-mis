@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Wedding Document Requests</h1>
                <hr>
                @include('layouts.message')
                @include('user.documentrequest.menu')
                <div class="py-3">
                    <a href="{{ route('client-documentrequestmatrimonylist') }}" class="btn btn-success btn-sm" >Back to List</a>
                </div>
                <form action="{{ route('client-documentrequestmatrimonysave') }}" method="post">
                    @include('user.documentrequest.matrimony.matrimonyform')
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="/vendor/jquery/jquery-3.5.1.js"></script>
    
@endpush