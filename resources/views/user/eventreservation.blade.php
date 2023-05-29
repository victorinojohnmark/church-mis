@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1>Rservations</h1>
                <hr>
                @include('layouts.message')
                <div class="py-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eventReservationModal">Create Reservation</button>
                    <div class="modal fade" id="eventReservationModal" tabindex="-1" aria-labelledby="eventReservationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="eventReservationModalLabel">Reservation Form</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{-- reservation form here --}}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>

                          </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="eventreservations-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Reservation Code</th>
                                <th>Event</th>
                                <th>Date Requested</th>
                                <th>Date Submitted</th>
                                <th>Status</th>
                                <th>Options</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
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
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#eventreservations-table').DataTable();
        });
    </script>
@endpush