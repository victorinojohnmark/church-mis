@extends('layouts.app')

@section('content')
<div id="bg-login">
    <img src="/img/bg-login.png" alt="bg login">
</div>
<div class="container">
    <div class="form-signin w-100 m-auto mt-5 p-4 shadow-sm bg-body-tertiary">
        <form action="{{ route('login') }}" method="POST">
            @csrf
          <h3 class="mb-3 fw-normal text-right">Log in</h3>

            <div class="mb-2">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
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
      
          <button class="btn btn-primary w-auto me-2" type="submit">Log in</button>
          <a href="{{ route('password.request') }}" class="bt btn-default w-auto">Forgot Password</a>

          
        </form>

        
      </div>
</div>
@endsection
