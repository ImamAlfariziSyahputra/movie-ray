@extends('layouts.dashboard')

@section('title')
Edit User
@endsection

@section('bc')
{{ Breadcrumbs::render('editUser', $user) }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                            value="{{ old('name', $user->name) }}"
                            placeholder="Enter name..."
                            readonly
                        >
                        @error('name')
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
                            value="{{ old('email', $user->email) }}"
                            placeholder="Enter email..."
                            readonly
                        >
                        @error('email')
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
                            @if (old('role', $selectedRole))
                            <option value='{{ old('role', $selectedRole)->id }}' selected>
                                {{ old('role', $selectedRole)->name }}
                            </option>
                            @endif
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="float-right">
                        <a href="{{ route('users.index') }}" class="btn btn-warning text-white">
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