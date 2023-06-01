<div class="modal fade" id="baptismModal{{ $baptism->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Baptism Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div class="modal-body">
                @include('admin.baptism.baptismform')
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>