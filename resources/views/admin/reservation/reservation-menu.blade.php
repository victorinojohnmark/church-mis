<div class="py-3">
    {{-- options here --}}
    <a href="{{ route('baptismlist') }}" class="btn btn-danger mb-1 {{ request()->routeIs('clientbaptism') ? 'active' : '' }}">Baptism</a>
    <a href="{{ route('communionlist') }}" class="btn btn-pink mb-1 {{ request()->routeIs('communionlist') ? 'active' : '' }}">First Holy Communion</a>
    <a href="{{ route('confirmationlist') }}" class="btn btn-success mb-1 {{ request()->routeIs('confirmationlist') ? 'active' : '' }}">Confirmation</a>
    <a href="{{ route('matrimonylist') }}" class="btn btn-info mb-1 {{ request()->routeIs('matrimonylist') ? 'active' : '' }}">Wedding</a>
    <a href="{{ route('blessinglist') }}" class="btn btn-warning mb-1 {{ request()->routeIs('blessinglist') ? 'active' : '' }}">Blessings</a>
    <a href="{{ route('funerallist') }}" class="btn btn-secondary mb-1 {{ request()->routeIs('funerallist') ? 'active' : '' }}">Funeral</a>
</div>