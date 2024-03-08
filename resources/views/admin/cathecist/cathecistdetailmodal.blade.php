<div class="modal fade" id="cathecistModal{{ $cathecist->id }}" tabindex="-1" aria-labelledby="cathecistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="cathecistModalLabel">Catechist Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form action="{{ route('catheciststore', ['id' => $cathecist->id]) }}" method="post">
                @csrf
                <div class="d-flex flex-column">
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name', $cathecist->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control" placeholder="Enter Birth Date" value="{{ old('birth_date', $cathecist->birth_date) }}" required>
                        @error('birth_date')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Sex</label>
                        <select name="sex" id="sex" class="form-control" required>
                            <option value="{{ null }}" disabled selected>Select here...</option>
                            @php
                                $sex = ['Male', 'Female']
                            @endphp
                            @forelse ($sex as $item)
                                <option {{ $cathecist->name == $item ? 'selected' : null }}>{{ $item }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Address</label>
                        <textarea name="address" class="form-control" placeholder="Enter Home Address" required>{{ old('address', $cathecist->address) }}</textarea>
                        @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" value="{{ old('contact_number', $cathecist->contact_number) }}" required>
                        @error('contact_number')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email', $cathecist->email) }}" required {{ $cathecist->id ? 'readonly' : null }}>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    @if (!$cathecist->id)
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Enter Password" required>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> --}}

      </div>
    </div>
</div>