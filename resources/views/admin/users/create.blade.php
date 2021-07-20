@extends('layouts.dashboard')

@section('title')
Add User
@endsection

@section('bc')
{{ Breadcrumbs::render('addUser') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    {{-- Name --}}
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            Name
                        </label>
                        <input 
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Enter name..."
                        >
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Role --}}
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select 
                            class="form-control @error('role') is-invalid @enderror" 
                            id="role" 
                            name="role"
                            data-placeholder="Choose"
                        >
                            @if (old('role'))
                            <option value='{{ old('role')->id }}'>
                                {{ old('role')->name }}
                            </option>
                            @endif
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email" class="font-weight-bold">
                            Email
                        </label>
                        <input 
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="Enter email..."
                        >
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Password --}}
                    <div class="form-group">
                        <label for="password" class="font-weight-bold">
                            Password
                        </label>
                        <input 
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            id="password"
                            value=""
                            placeholder="Enter password..."
                        >
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Password Confirmation --}}
                    <div class="form-group">
                        <label for="password_confirmation" class="font-weight-bold">
                            Password Confirmation
                        </label>
                        <input 
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            id="password_confirmation"
                            value=""
                            placeholder="Enter password confirmation..."
                        >
                    </div>
                    <div class="float-right">
                        <a href="" class="btn btn-warning text-white">
                            Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@push('custCss')
{{-- Select2 --}}
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
@endpush

@push('custJs')
{{-- Select2 --}}
<script src="{{asset('vendor/select2/js/select2.min.js') }}"></script>

<script>
$(() => {
    // Select2 Multiple : Casts
    $('#role').select2({
        theme: 'bootstrap4',
        language: "{{ app()->getLocale() }}",
        allowClear: true,
        ajax: {
            url: "{{ route('roles.select') }}",
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
})
</script>
@endpush

@endsection