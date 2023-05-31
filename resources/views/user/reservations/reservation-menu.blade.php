<div class="py-3">
    {{-- options here --}}
    <a href="{{ route('clientbaptism') }}" class="btn btn-primary rounded-pill mb-1 {{ request()->routeIs('clientbaptism') ? 'active' : '' }}">Baptism</a>
    <a href="{{ route('clientcommunion') }}" class="btn btn-primary rounded-pill mb-1 {{ request()->routeIs('clientcommunion') ? 'active' : '' }}">First Holy Communion</a>
    <a href="{{ route('clientconfirmation') }}" class="btn btn-primary rounded-pill mb-1 {{ request()->routeIs('clientconfirmation') ? 'active' : '' }}">Confirmation</a>
    <a href="{{ route('clientmatrimony') }}" class="btn btn-primary rounded-pill mb-1 {{ request()->routeIs('clientmatrimony') ? 'active' : '' }}">Matrimony</a>
    <a href="{{ route('clientblessing') }}" class="btn btn-primary rounded-pill mb-1 {{ request()->routeIs('clientmblessing') ? 'active' : '' }}">Blessings</a>
    <a href="{{ route('clientfuneral') }}" class="btn btn-primary rounded-pill mb-1 {{ request()->routeIs('clientmblessing') ? 'active' : '' }}">Funeral</a>
</div>