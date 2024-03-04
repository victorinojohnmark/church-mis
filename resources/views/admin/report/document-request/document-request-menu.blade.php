<div class="py-3">
    <a href="{{ route('report-docrequest-baptism') }}" class="btn btn-success {{ request()->routeIs('report-docrequest') || request()->routeIs('report-docrequest-baptism') ? 'active' : '' }}">Baptism</a>
    <a href="{{ route('report-docrequest-confirmation') }}" class="btn btn-success {{ request()->routeIs('report-docrequest-confirmation') ? 'active' : '' }}">Confirmation</a>
    {{-- <a href="{{ route('report-docrequest-communion') }}" class="btn btn-success {{ request()->routeIs('report-docrequest-communion') ? 'active' : '' }}">First Communion</a> --}}
    {{-- <a href="{{ route('report-docrequest-matrimony') }}" class="btn btn-success {{ request()->routeIs('report-docrequest-matrimony') ? 'active' : '' }}">Wedding</a> --}}
    {{-- <a href="{{ route('report-docrequest-blessing') }}" class="btn btn-success {{ request()->routeIs('report-docrequest-blessing') ? 'active' : '' }}">Blessings</a> --}}
    {{-- <a href="{{ route('report-docrequest-death') }}" class="btn btn-success {{ request()->routeIs('report-docrequest-death') ? 'active' : '' }}">Death</a> --}}
</div>