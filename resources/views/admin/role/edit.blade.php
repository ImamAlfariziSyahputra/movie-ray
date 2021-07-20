@extends('layouts.dashboard')

@section('title')
Edit Role
@endsection

@section('bc')
{{ Breadcrumbs::render('editRole', $role) }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            Role Name
                        </label>
                        <input 
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id="name"
                            value="{{ old('name', $role->name) }}"
                            placeholder="Enter role name..."
                        >
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Permissions --}}
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            Permissions
                        </label>
                        <div class="form-control overflow-auto h-100 @error('permissions') is-invalid @enderror">
                            <div class="row">
                                @foreach ($authorities as $manageName => $permissions)
                                <ul class="list-group mx-1 mb-3">
                                    <li class="list-group-item bg-dark text-white">
                                        {{ $manageName }}
                                    </li>
                                    
                                    <!-- list permission:start -->
                                    @foreach ($permissions as $permission)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input 
                                                id="{{ $permission }}"
                                                class="form-check-input"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission }}"
                                                @if (old('permissions', $checkedRole) )
                                                {{ 
                                                    in_array($permission, old('permissions', $checkedRole))
                                                    ? 'checked'
                                                    : null
                                                }}
                                                @endif
                                            >
                                            <label for="{{ $permission }}" class="form-check-label">
                                                {{ $permission }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
    
                                    <!-- list permission:end -->
                                </ul>
                                @endforeach
                                
                            </div>
                        </div>
                        @error('permissions')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="float-right">
                        <a href="{{ route('roles.index') }}" class="btn btn-warning text-white">
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

@endsection