@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @if (Auth::id())
            @include('user.sidebarmenu')
        @endif

        <div class="col-md-9">
            <div id="content" class="px-3">
                @csrf
                <h1>Reset Password</h1>
                <hr>
                @include('layouts.message')

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                        </div>
                    </div>

                    {{-- <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div> --}}
                </form>

                <img src="/img/bg-forgot.png" class="img-fluid mt-5" style="max-width: 350px;">
                  
            </div>
        </div>
    </div>
</div>
@endsection
