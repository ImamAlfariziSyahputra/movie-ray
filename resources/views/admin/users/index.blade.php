@extends('layouts.dashboard')

@section('title')
Users
@endsection

@section('bc')
{{ Breadcrumbs::render('user') }}
@endsection

@section('content')

<div class="col-md-12 p-0">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="col-md-5 p-0">
                <form action="{{ route('users.index') }}" method="GET" class="">
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
            <div class="col-md-7 p-0 d-flex justify-content-end">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    Add
                    <i class="fa fa-fw fa-plus-square"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($users as $user)
                <div class="col-md-4 p-3">
                    <div class="card">
                        <div class="card-body row no-gutters pb-0">
                            <div class="col-md-2">
                                <i class="fa fa-3x fa-id-badge"></i>
                            </div>
                            <div class="col-md-10 pl-2">
                                <table>
                                    <tr>
                                        <th>Name</th>
                                        <td>:</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>:</td>
                                        <td>Admin</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pb-3 px-3">
                            {{-- Edit --}}
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-success mr-2">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            {{-- Delete --}}
                            <form 
                                action="{{ route('users.destroy', $user) }}" 
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
                </div>
                @endforeach
            </div>
        </div>
        @if ($users->hasPages())
        <div class="card-footer">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
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