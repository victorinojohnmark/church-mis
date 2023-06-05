@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1>Matrimony</h1>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#matrimonyFormModal">Create Matrimony Reservation</button>
                    <div class="modal fade" id="matrimonyFormModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Matrimony Reservation Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="#" method="post">
                                    <input type="hidden" name="created_by_id" value="{{ Auth::id() }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Groom's Name</label>
                                                <input type="text" name="grooms_name" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Groom's Birth Date</label>
                                                <input type="date" name="grooms_birth_date" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bride's Name</label>
                                                <input type="text" name="brides_name" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Bride's Birth Date</label>
                                                <input type="date" name="brides_birth_date" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Matrimony Date</label>
                                                <input type="date" name="wedding_date" class="form-control" placeholder="..." required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control" placeholder="..." required>
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
                <table id="baptism-table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Broom and Bride's Name</th>
                            <th>Wedding Date</th>
                            <th>Submitted At</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($matrimonies as $matrimony)
                        <tr>
                            <td>
                                {{ $matrimony->grooms_name }} / {{ $matrimony->brides_name }}
                                @if ($matrimony->is_accepted)
                                    <span class="badge bg-success">Accepted</span>
                                @elseif ($matrimony->is_rejected)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $matrimony->wedding_date }}</td>
                            <td>{{ $matrimony->created_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#matrimonyModal{{ $matrimony->id }}">View</button>
                                <div class="modal fade" id="matrimonyModal{{ $matrimony->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Matrimony Reservation Form</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('clientmatrimonysave') }}" method="post">
                                                <div class="modal-body">
                                                    @include('user.matrimony.matrimonyform')
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
            $('#baptism-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush