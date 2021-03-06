@extends('layouts.dashboard')

@section('title')
Detail Role
@endsection

@section('bc')
{{ Breadcrumbs::render('detailRole', $role) }}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="input_role_name" class="font-weight-bold">
                        Name
                    </label>
                    <input 
                        id="input_role_name" 
                        value="{{ $role->name }}" 
                        name="name" 
                        type="text" 
                        class="form-control" 
                        readonly />
                </div>
                <!-- permission -->
                <div class="form-group pl-2">
                    <label for="input_role_permission" class="font-weight-bold">
                        asd
                    </label>
                    <div class="row">
                        <!-- list manage name:start -->
                        @forelse ($authorities as $manageName => $permissions)
                        <ul class="list-group mx-1 mb-3">
                            <li class="list-group-item bg-dark text-white">
                                {{ $manageName }}
                            </li>
                            
                            @foreach ($permissions as $permission)
                            <!-- list permission:start -->
                            <li class="list-group-item">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox"
                                        value="" 
                                        onclick="return false;" 
                                        {{ in_array($permission, $rolePermissions) ? 'checked' : null }}
                                        >
                                    <label class="form-check-label">
                                        {{ $permission }}
                                    </label>
                                </div>
                            </li>
                            @endforeach

                            <!-- list permission:end -->
                        </ul>
                        @empty
                        <p>
                            <strong>
                                No data roles yet.
                            </strong>
                        </p>
                        @endforelse
                            
                        
                        <!-- list manage name:end  -->
                    </div>
                </div>
                <!-- button  -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary mx-1" role="button">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection