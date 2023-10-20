<div class="col-md-3">
    {{-- <div id="" class="mb-3">
        <div class="list-group rounded-0">
            <a href="{{ route('userprofile') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('userprofile') ? 'active' : '' }}">Profile</a>
            <a href="{{ route('usernotification') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('usernotification') ? 'active' : '' }}">Notifications</a>
            <a href="{{ route('clientreservations') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('clientreservations') ? 'active' : '' }}">Reservations</a>
            <a href="{{ route('client-documentrequestlist') }}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('client-documentrequestlist') ? 'active' : '' }}">Document Requests</a>
            
            <a href="{{ route('password.request') }}" class="list-group-item list-group-item-action py-2">Forgot Password</a>
        </div>
    </div> --}}

    <ul id="userSidebar" class="mb-3">
        <li><a href="{{ route('userprofile') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('userprofile') ? 'active' : '' }}"><i class="fas fa-user me-2"></i> Profile</a></li>
        <li><a href="{{ route('usernotification') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('usernotification') ? 'active' : '' }}"><i class="fas fa-bell me-2"></i> Inbox</a></li>
        <li><a href="{{ route('clientreservations') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('clientreservations') ? 'active' : '' }}"><i class="fas fa-calendar me-2"></i> Event Reservations</a></li>
        <li><a href="{{ route('client-documentrequestlist') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('client-documentrequestlist') ? 'active' : '' }}"><i class="fas fa-file-circle-check me-2"></i> Document Request</a></li>
        <li><a href="{{ route('password.request') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('password.request') ? 'active' : '' }}"><i class="fas fa-person-circle-question me-2"></i> Forgot Password</a></li>

    </ul>
</div>

