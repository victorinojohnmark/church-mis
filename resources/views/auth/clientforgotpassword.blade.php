@extends('layouts.app')

@section('content')
{{-- <div id="bg-login">
    <img src="/img/bg-login.png" alt="bg login">
</div> --}}
<div class="vw-100 vh-100 z-n1 position-absolute top-0" style="background-color: #39B5A4;"></div>
<div class="">
    <div class="container">
        <h3 class="text-center mt-5 text-white fw-bold">SAINT GREGORY <br> THE GREAT PARISH CHURCH</h3>
        <div class="form-signin w-100 m-auto mt-3 p-4 shadow-sm bg-body-tertiary rounded-3">
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
              {{-- <h3 class="mb-3 fw-normal text-right">Log in</h3> --}}
                <div class="d-flex flex-row justify-content-center align-items-center text-center mb-3">
                    <a href="/login" class="flex-fill bg-secondary-subtle text-decoration-none p-3 text-white">LOGIN</a>
                    <a href="#" class="flex-fill bg-warning text-decoration-none p-3 text-white">FORGOT PASSWORD</a>
                </div>

                <div class="mb-2">
                    <label class="form-label text-black fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control rounded p-3" placeholder="Enter Email Address" required>
                </div>
    
                <div class="mb-3">
                    <label class="form-label text-black fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control rounded p-3" placeholder="Enter Password" required>
                </div>
    
                @error('email')
                    <span class="invalid-feedback d-block text-left mb-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
    
                @error('password')
                    <span class="invalid-feedback d-block text-left mb-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          
              <button class="btn btn-warning w-100 me-2 rounded-3 text-white p-3" type="submit">LOGIN</button>
              {{-- <a href="{{ route('password.request') }}" class="bt btn-default w-auto">Forgot Password</a> --}}
    
              
            </form>
    
            
          </div>
    </div>
</div>
@endsection
