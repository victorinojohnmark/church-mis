@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        @include('user.sidebarmenu')

        <div class="col-md-9">
            <div id="content" class="px-3">
                <form action="{{ route('userprofileupdate') }}" method="POST">
                @csrf
                <h1 style="color: #39B5A4;">Profile</h1>
                <hr>
                @include('layouts.message')
                  <h5 class="mb-3 fw-normal text-right">Personal Information</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('name', $user->email) }}" readonly disabled>
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $user->birth_date) }}" required>
                        @error('birth_date')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sex</label>
                        <select name="sex" id="sex" class="form-control" required>
                            @php
                                $sex = ['Male', 'Female']
                            @endphp
                            @forelse ($sex as $item)
                                <option {{ $user && $user->sex == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" required>{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $user->contact_number) }}" required>
                        @error('contact_number')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
              
                  <div class="d-flex inline-flex align-items-center">
                    <button class="w-100 btn btn-primary w-auto" type="submit">Update</button>
                  </div>
                
                  
                </form>
            </div>
        </div>
    </div>
</div>
@endsection