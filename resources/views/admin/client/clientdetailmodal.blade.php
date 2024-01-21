<div class="modal fade" id="clientModal{{ $client->id }}" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="clientModalLabel">Client Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="d-flex flex-column">
                <div>
                    <label class="text-secondary">Name</label>
                    <p class="fs-5">{{ $client->name }}</p>
                </div>
                <div>
                    <label class="text-secondary">Birth Date</label>
                    <p class="fs-5">{{ $client->birth_date }}</p>
                </div>
                <div>
                    <label class="text-secondary">Sex</label>
                    <p class="fs-5">{{ $client->sex }}</p>
                </div>
                <div>
                    <label class="text-secondary">Address</label>
                    <p class="fs-5">{{ $client->address }}</p>
                </div>
                <hr>
                <h5>Contact Information</h5>
                <div>
                    <label class="text-secondary">Phone No.</label>
                    <a href="tel:{{ $client->contact_number }}" class="fs-5 text-decoration-none text-default">{{ $client->contact_number }}</a>
                </div>
                <div>
                    <label class="text-secondary">Email Address</label>
                    <a href="mailto:{{ $client->email }}" class="fs-5 text-decoration-none text-default">{{ $client->email }}</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
</div>