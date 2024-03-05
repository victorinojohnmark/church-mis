<div class="modal fade" id="funeralModalDelete{{ $funeral->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Delete Funeral Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <form action="{{ route('funeraldelete', ['funeral' => $funeral->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this funeral reservation?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Confirm Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </form>
        </div>
    </div>
</div>