@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1>Communion</h1>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#communionFormModal">Create Communion Reservation</button>
                    <div class="modal fade" id="communionFormModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Communion Reservation Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('clientcommunionsave') }}" method="post">
                                    <input type="hidden" name="created_by_id" value="{{ Auth::id() }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Desired Date</label>
                                                <input type="date" name="date" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Birth Date</label>
                                                <input type="date" name="birth_date" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Father's Name</label>
                                                <input type="text" name="fathers_name" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Mother's Name</label>
                                                <input type="text" name="mothers_name" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Contact #</label>
                                                <input type="text" name="contact_number" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Present Address</label>
                                                <textarea name="present_address" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="communion-table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Submitted At</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($communions as $communion)
                        <tr>
                            <td>{{ $communion->name }}</td>
                            <td>{{ $communion->birth_date }}</td>
                            <td>{{ $communion->created_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#communionModal{{ $communion->id }}">View</button>
                                <div class="modal fade" id="communionModal{{ $communion->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Communion Reservation Form</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('clientcommunionsave') }}" method="post">
                                                <div class="modal-body">
                                                    @include('user.communion.communionform')
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
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
            $('#communion-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush