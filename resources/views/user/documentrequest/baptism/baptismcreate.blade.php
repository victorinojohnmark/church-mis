@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="color: #39B5A4;">Baptism Document Requests</h1>
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
                @include('user.documentrequest.menu')
                <div class="py-3">
                    <a href="{{ route('client-documentrequestbaptismlist') }}" class="btn btn-success btn-sm" >Back to List</a>
                </div>
                <form action="{{ route('client-documentrequestbaptismsave') }}" method="post">
                    @include('user.documentrequest.baptism.baptismform')
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
    
    <script>
        // var baptismalDateInput = document.querySelector('input[name="baptismal_date"]');
        // var unknownDateCheckbox = document.querySelector('input[name="is_unknown_date"]');

        // console.log(baptismalDateInput, unknownDateCheckbox)
        
        // // Function to handle checkbox state change
        // function handleCheckboxChange() {
        //     console.log('Checkbox changed!');
        //     if (unknownDateCheckbox.checked) {
        //         baptismalDateInput.value = ''; // Clear the value
        //         baptismalDateInput.disabled = true; // Disable the input
        //     } else {
        //         baptismalDateInput.disabled = false; // Enable the input
        //     }
        // }

        // // Add event listener to checkbox change event
        // unknownDateCheckbox.addEventListener('input', () => {
        //     console.log('click')
        // });

        document.addEventListener('DOMContentLoaded', function() {
        var baptismalDateInput = document.querySelector('input[name="baptismal_date"]');
        var unknownDateCheckbox = document.querySelector('input[name="is_unknown_date"]');

        // Function to handle checkbox state change
        function handleCheckboxChange() {
            if (unknownDateCheckbox.checked) {
                baptismalDateInput.value = ''; // Clear the value
                baptismalDateInput.disabled = true; // Disable the input
                baptismalDateInput.required = false;
            } else {
                baptismalDateInput.disabled = false; // Enable the input
                baptismalDateInput.required = true;
            }
        }

        // Add event listener to checkbox change event
        unknownDateCheckbox.addEventListener('change', handleCheckboxChange);
        unknownDateCheckbox.addEventListener('input', handleCheckboxChange);

        // Initial execution
        handleCheckboxChange();
    });
    </script>
@endpush