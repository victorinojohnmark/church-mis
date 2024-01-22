@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="color: #39B5A4;">Baptism</h1>
                    <!-- Bell Icon with Notification Count -->
                    {{-- <a href="{{ route('usernotification') }}" class="">
                        <div class="position-relative" style="padding-right: 12px;">
                            <i class="fas fa-bell pr-3" style="font-size: 25px;"></i>
                            <span class="notification-pill badge bg-danger rounded-circle">{{ $notificationCount }}</span>
                        </div>
                        
                    </a> --}}
                </div>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <a href="{{ route('clientbaptism') }}" class="btn btn-success btn-sm" >Back to List</a>
                </div>
                <form action="{{ route('clientbaptismsave', ['baptism' => $baptism->id]) }}" method="post">
                    @include('user.baptism.baptismform')
                    <input type="hidden" name="created_by_id" value="{{ Auth::id() }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
        function toggleRelationshipDetail() {
            var relationshipValue = document.getElementById('relationship').value;
            var otherRelationshipInput = document.getElementById('other_relationship');
    
            if (relationshipValue === 'Other') {
                otherRelationshipInput.disabled = false;
                otherRelationshipInput.required = true;
                otherRelationshipInput.style.display = 'block';
            } else {
                otherRelationshipInput.disabled = true;
                otherRelationshipInput.required = false;
                otherRelationshipInput.style.display = 'none';
            }
        }
    
        // Initial state
        toggleRelationshipDetail();
    </script>
@endpush