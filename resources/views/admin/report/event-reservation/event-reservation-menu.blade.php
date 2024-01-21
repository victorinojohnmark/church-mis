<div class="py-3">
    {{-- options here --}}
    <a href="{{ route('report-baptismlist') }}" class="btn btn-success mb-1 {{ request()->routeIs('report-baptismlist') || request()->routeIs('report-eventreservationlist') ? 'active' : '' }}">Baptism</a>
    <a href="{{ route('report-communionlist') }}" class="btn btn-success mb-1 {{ request()->routeIs('report-communionlist') ? 'active' : '' }}">First Communion</a>
    <a href="{{ route('report-confirmationlist') }}" class="btn btn-success mb-1 {{ request()->routeIs('report-confirmationlist') ? 'active' : '' }}">Confirmation</a>
    <a href="{{ route('report-matrimonylist') }}" class="btn btn-success mb-1 {{ request()->routeIs('report-matrimonylist') ? 'active' : '' }}">Wedding</a>
    <a href="{{ route('report-blessinglist') }}" class="btn btn-success mb-1 {{ request()->routeIs('report-blessinglist') ? 'active' : '' }}">Blessings</a>
    <a href="{{ route('report-funerallist') }}" class="btn btn-success mb-1 {{ request()->routeIs('report-funerallist') ? 'active' : '' }}">Funeral</a>
</div>