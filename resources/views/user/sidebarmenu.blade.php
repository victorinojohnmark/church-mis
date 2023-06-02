<div class="col-md-3">
    <div id="userSidebar" class="mb-3">
        <div class="list-group rounded-0">
            <a href="{{ route('userprofile') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('userprofile') ? 'active' : '' }}">Profile</a>
            <a href="{{ route('clientreservations') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('clientreservations') ? 'active' : '' }}">Reservations</a>
            <a href="{{ route('client-documentrequestlist') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('client-documentrequestlist') ? 'active' : '' }}">Document Requests</a>
            <a href="#" class="list-group-item list-group-item-action py-2">Account Details</a>
        </div>
    </div>
</div>