@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="form-register w-100 m-auto mt-5 shadow bg-body-tertiary">
        <form action="{{ route('register') }}" method="POST">
            @csrf
          <h3 class="mb-3 fw-normal text-right font-inter" style="color: #39B5A4;">SIGN UP</h3>
            
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Birth Date</label>
                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                @error('birth_date')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                @error('address')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
                @error('contact_number')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <h5>Log in information</h5>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
                @error('password-confirmation')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
      
          <div class="d-flex inline-flex align-items-center">
            <button class="w-100 btn btn-primary w-auto" type="submit">Register</button>
            <a href="/login" class="px-2 text-decoration-none">Already registered?</a>
          </div>
        
          
        </form>
      </div>
</div> --}}

<div class="container">
    <h3 class="text-center mt-5 text-white fw-bold">SAINT GREGORY <br> THE GREAT PARISH CHURCH</h3>
    <div class="form-signin w-100 m-auto mt-3 mb-3 p-5 shadow-sm bg-body-tertiary rounded-3">
        <h3 class="mb-3 fw-normal text-right fw-bold font-inter text-center" style="color: #39B5A4;">SIGN UP</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Name</label>
                <input type="text" name="name" class="form-control rounded p-3" placeholder="Enter Name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Birth Date</label>
                <input type="date" name="birth_date" class="form-control rounded p-3" placeholder="Enter Birth Date" value="{{ old('birth_date') }}" required>
                @error('birth_date')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Sex</label>
                <select name="sex" id="sex" class="form-control rounded p-3" value="{{ old('sex') }}">
                    <option value="" disabled {{ old('sex') == '' ? 'selected' : '' }}>Select here...</option>
                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Address</label>
                <textarea name="address" class="form-control rounded p-3" placeholder="Enter Home Address" required>{{ old('address') }}</textarea>
                @error('address')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Contact Number</label>
                <input type="text" name="contact_number" class="form-control rounded p-3" placeholder="Enter Contact Number" value="{{ old('contact_number') }}" required>
                @error('contact_number')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Email address</label>
                <input type="email" name="email" class="form-control rounded p-3" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded p-3" placeholder="Enter Password" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-dark fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded p-3" placeholder="Enter Confirm Password" required>
                @error('password-confirmation')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
      
          <button class="btn btn-warning w-100 me-2 rounded-3 text-white p-3 mb-2" type="submit">SIGN UP</button>
          <span class="text-dark fs-6 fw-semibold">ALREADY HAVE AN ACCOUNT?<a href="/login" class="px-2 text-decoration-none">CLICK HERE</a></span>
          {{-- <a href="{{ route('password.request') }}" class="bt btn-default w-auto">Forgot Password</a> --}}

          
        </form>

        
      </div>
</div>
@endsection

@push('scripts')
    <style>
        body {
            background-color: #39B5A4 !important;
        }
    </style>
@endpush
