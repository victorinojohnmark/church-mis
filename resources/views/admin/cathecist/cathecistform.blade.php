@extends('layouts.admin')

@section('title', 'Catechists')

@section('content')
<div class="py-3">
    <a class="btn btn-success" href="{{ route('cathecistlist') }}">Back to Catechist List</a>
</div>

<form action="{{ route('catheciststore', ['id' => $cathecist->id]) }}" class="mb-3" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $cathecist->id }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label text-dark fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name', $cathecist->name) }}" required>
            @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label text-dark fw-semibold">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" placeholder="Enter Birth Date" value="{{ old('birth_date', $cathecist->birth_date) }}" required>
            @error('birth_date')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label text-dark fw-semibold">Sex</label>
            <select name="sex" id="sex" class="form-control" required>
                <option value="{{ null }}" disabled selected>Select here...</option>
                @php
                    $sex = ['Male', 'Female']
                @endphp
                @forelse ($sex as $item)
                    <option {{ $cathecist->sex == $item ? 'selected' : null }} {{ old('sex') == $item ? 'selected' : null }}>{{ $item }}</option>
                @empty
                    
                @endforelse
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label text-dark fw-semibold">Address</label>
            <textarea name="address" class="form-control" placeholder="Enter Home Address" required>{{ old('address', $cathecist->address) }}</textarea>
            @error('address')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label text-dark fw-semibold">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" value="{{ old('contact_number', $cathecist->contact_number) }}" required>
            @error('contact_number')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label text-dark fw-semibold">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email', $cathecist->email) }}" required {{ $cathecist->id ? 'readonly' : null }}>
            @error('email')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        @if (!$cathecist->id)
        <div class="col-md-4 mb-3">
            <label class="form-label text-dark fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Enter Password" required>
            @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label text-dark fw-semibold">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" {{ old('password_confirmation') }} placeholder="Enter Confirm Password" required>
            @error('password-confirmation')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>


@endsection
