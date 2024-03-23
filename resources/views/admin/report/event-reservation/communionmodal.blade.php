<div class="modal fade" id="communionModal{{ $communion->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Communion Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                <table class="table" id="communionDetailTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Guardian</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>

                    {{ $communion }}
                    <tbody>
                        @forelse ($communion->details as $detail)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->birth_date }}</td>
                            <td>{{ $detail->guardian }}</td>
                            <td>{{ $detail->contact_number }}</td>
                            <td>{{ $detail->present_address }}</td>
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