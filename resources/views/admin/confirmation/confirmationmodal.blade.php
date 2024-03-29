<div class="modal fade" id="confirmationModal{{ $confirmation->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Confirmation Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                {{-- @include('admin.confirmation.confirmationform') --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Father</th>
                            <th scope="col">Mother</th>
                            <th scope="col">Sponsor 1</th>
                            <th scope="col">Sponsor 2</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Option</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($confirmation->details as $detail)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->birth_date }}</td>
                            <td>{{ $detail->father }}</td>
                            <td>{{ $detail->mother }}</td>
                            <td>{{ $detail->sponsor_1 }}</td>
                            <td>{{ $detail->sponsor_2 }}</td>
                            <td>{{ $detail->contact_number }}</td>
                            <td>{{ $detail->present_address }}</td>
                            <td><a href="{{ route('confirmationprint', ['confirmation_detail' => $detail->id]) }}" target="_blank" class="btn btn-success btn-sm">Print</a></td>
                        </tr>
                        @empty
                            
                        @endforelse
                        
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>