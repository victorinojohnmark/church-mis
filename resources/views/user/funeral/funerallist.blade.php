@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <h1 style="color: #39B5A4;">Funeral</h1>
                <hr>
                @include('layouts.message')
                @include('user.reservations.reservation-menu')
                <div class="py-3">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#blessingFormModal">Create Funeral Mass Reservation</button>
                    <div class="modal fade" id="blessingFormModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Funeral Reservation Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="#" method="post">
                                    <input type="hidden" name="created_by_id" value="{{ Auth::id() }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            {{-- <div class="col-md-6 mb-3">
                                                <label class="form-label">Date of Mass</label>
                                                <input type="date" name="date" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Time</label>
                                                <input type="time" name="time" class="form-control" placeholder="..." required>
                                            </div> --}}
                                        
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Age</label>
                                                <input type="number" name="age" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                @php
                                                    $statuses = ['Single', 'Married'];
                                                @endphp
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control" required>
                                                    @forelse ($statuses as $status)
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @empty
                                                        
                                                    @endforelse
                                                </select>
                                            </div>
                                        
                                            
                                        
                                            {{-- <div class="col-md-6 mb-3">
                                                <label class="form-label">Religion</label>
                                                <input type="text" name="religion" class="form-control" placeholder="..." required>
                                            </div> --}}
                                        
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Address</label>
                                                <textarea name="address" class="form-control" cols="10" rows="2"></textarea>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date of Death</label>
                                                <input type="date" name="date_of_death" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Cause of Death</label>
                                                <input type="string" name="cause_of_death" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Cemetery</label>
                                                <input type="text" name="cemetery" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Funeraria</label>
                                                <input type="text" name="funeraria" class="form-control" placeholder="..." required>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Contact Person</label>
                                                <input type="text" name="contact_person" class="form-control" placeholder="..." required>
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
                <table id="blessing-table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of Mass</th>
                            <th>Time</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($funerals as $funeral)
                        <tr>
                            <td>
                                {{ $funeral->name }}
                                @if ($funeral->is_accepted)
                                    <span class="badge bg-success">Accepted</span>
                                @elseif ($funeral->is_rejected)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $funeral->date }}</td>
                            <td>{{ $funeral->time }}</td>
                            <td>{{ $funeral->age }}</td>
                            <td>{{ $funeral->address }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#funeralModal{{ $funeral->id }}">View</button>
                                <div class="modal fade" id="funeralModal{{ $funeral->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Funeral Mass Reservation Form</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('clientfuneralsave') }}" method="post">
                                                <div class="modal-body">
                                                    @include('user.funeral.funeralform')
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
            $('#blessing-table').DataTable({
                dom: 'ftp'
            });
        });
    </script>
@endpush