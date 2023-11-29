@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row mt-5">

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
                </form>

                <img src="/img/bg-forgot.png" class="img-fluid mt-5" style="max-width: 350px;">
                  
            </div>
        </div>
    </div>
</div> --}}

<div class="vw-100 vh-100 z-n1 position-absolute top-0" style="background-color: #39B5A4;"></div>
<div class="">
    <div class="container">
        <h3 class="text-center mt-5 text-white fw-bold">SAINT GREGORY <br> THE GREAT PARISH CHURCH</h3>
        
        <div class="form-signin w-100 m-auto mt-3 p-5 shadow-sm bg-body-tertiary rounded-3">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
              {{-- <h3 class="mb-3 fw-normal text-right">Log in</h3> --}}
                {{-- <div class="d-flex flex-row justify-content-center align-items-center text-center mb-3">
                    @if (Auth::id())
                        <a href="/user/profile" class="flex-fill bg-secondary-subtle text-decoration-none p-3 text-white">MY PROFILE</a>
                    @else
                        <a href="/login" class="flex-fill bg-secondary-subtle text-decoration-none p-3 text-white">LOGIN</a>
                    @endif
                    <a href="{{ route('password.email') }}" class="flex-fill bg-warning text-decoration-none p-3 text-white">FORGOT PASSWORD</a>
                </div> --}}

                <div class="mb-3">
                    <h4 class="text-dark fw-bold mb-2 font-inter">FORGOT PASSWORD?</h4>
                    <p class="text-secondary">Enter your email address and we'll send you instructions on how to reset your password.</p>
                </div>

                <div class="mb-2">
                    <label class="form-label text-black fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control rounded p-3 @error('email') is-invalid @enderror" placeholder="Enter Email Address" required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
    
          
              <button class="btn btn-warning w-100 me-2 rounded-3 text-white p-3" type="submit">Send Password Reset Link</button>
              {{-- <a href="{{ route('password.request') }}" class="bt btn-default w-auto">Forgot Password</a> --}}
    
              
            </form>
    
            
          </div>
    </div>
</div>
@endsection
