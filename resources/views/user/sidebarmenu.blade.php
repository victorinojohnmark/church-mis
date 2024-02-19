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
        @if (!auth()->user()->is_cathecist)
        <li><a href="{{ route('user.calendar.index') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('user.calendar.index') ? 'active' : '' }}"><i class="fas fa-calendar me-2"></i> Calendar</a></li>
        @endif
        <li><a href="{{ route('userprofile') }}" class="py-2 px-3 mb-2 text-dark rounded-pill {{ request()->routeIs('userprofile') ? 'active' : '' }}"><i class="fas fa-user me-2"></i> Profile</a></li>
        <li>
            <span class="w-100 py-2 px-3 mb-2 text-dark rounded-pill d-inline-flex justify-content-between align-items-center {{ request()->routeIs('clientreservations') ? 'active' : '' }}">
                <a href="{{ route('clientreservations') }}" class="text-decoration-none text-dark"><i class="fas fa-calendar me-2"></i> Event Reservations</a>
                <a href="/user/notifications/get-notification/event" class="notificationBadgeEvent badge bg-danger rounded-pill">0</a>
            </span>
        </li>
        @if (!auth()->user()->is_cathecist)
        <li>
            <span class="w-100 py-2 px-3 mb-2 text-dark rounded-pill d-inline-flex justify-content-between align-items-center {{ request()->routeIs('client-documentrequestlist') ? 'active' : '' }}">
                <a href="{{ route('client-documentrequestlist') }}" class="text-decoration-none text-dark"><i class="fas fa-calendar me-2"></i> Document Request</a>
                <a href="/user/notifications/get-notification/document_request" class="notificationBadgeDocumentRequest badge bg-danger rounded-pill">0</a>
            </span>
        </li>
        @endif
        
    </ul>
</div>

