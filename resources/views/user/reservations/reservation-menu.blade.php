<div class="py-3">
    {{-- options here --}}
    @if (auth()->user()->is_cathecist)
    <a href="{{ route('clientcommunion') }}" class="btn btn-primary mx-1 mb-1 {{ request()->routeIs('clientcommunion') ? 'active' : '' }}">First Holy Communion</a>
    <a href="{{ route('clientconfirmation') }}" class="btn btn-primary mx-1 mb-1 {{ request()->routeIs('clientconfirmation') ? 'active' : '' }}">Confirmation</a>
    @else
    <a href="{{ route('clientbaptism') }}" class="btn btn-danger mx-1 mb-1 {{ request()->routeIs('clientbaptism') ? 'active' : '' }}">Baptism</a>
    <a href="{{ route('clientmatrimony') }}" class="btn btn-info mx-1 mb-1 {{ request()->routeIs('clientmatrimony') ? 'active' : '' }}">Wedding</a>
    <a href="{{ route('clientblessing') }}" class="btn btn-success mx-1 mb-1 {{ request()->routeIs('clientblessing') ? 'active' : '' }}">Blessings</a>
    <a href="{{ route('clientfuneral') }}" class="btn btn-secondary mx-1 mb-1 {{ request()->routeIs('clientfuneral') ? 'active' : '' }}">Funeral</a>
    @endif
</div>