@extends('layouts.dashboard')

@section('title')
Roles
@endsection

@section('bc')
{{ Breadcrumbs::render('role') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-header d-flex justify-content-between no-gutters">
            <div class="col-md-6">
                <form action="{{ route('roles.index') }}" method="GET" class="">
                    <div class="input-group">
                        <input 
                            class="form-control"
                            type="text"
                            name="keyword"
                            value="{{ request()->get('keyword') }}"
                            placeholder="Search for..."
                            aria-label="Search"
                            aria-describedby="basic-addon2"
                        />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    Add
                    <i class="fa fa-plus-square"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                @foreach ($roles as $role)
                <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                    {{-- Data --}}
                    <div>
                        {{ $role->name }}
                    </div>
                    <div class="action d-flex">
                        {{-- Detail --}}
                        <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-info mr-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        {{-- Edit --}}
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-success mr-2">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        {{-- Delete --}}
                        <form 
                            action="{{ route('roles.destroy', $role) }}" 
                            method="POST" 
                            role="alert"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if ($roles->hasPages())
        <div class="card-footer">
            {{ $roles->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif
    </div>

</div>

@push('custJs')
<script>
$(() => {
    $('form[role="alert"]').submit((e) => {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
});
</script>
@endpush

@endsection