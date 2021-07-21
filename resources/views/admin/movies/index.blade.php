@extends('layouts.dashboard')

@section('title')
Movies
@endsection

@section('bc')
{{ Breadcrumbs::render('movie') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-header d-flex justify-content-between no-gutters">
            <div class="col-md-6">
                <form action="{{ route('movies.index') }}" method="GET" class="">
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
            @can('movies.create')
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('movies.create') }}" class="btn btn-primary">
                    Add
                    <i class="fa fa-plus-square"></i>
                </a>
            </div>
            @endcan
        </div>
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                @foreach ($movies as $movie)
                <div class="px-3 py-2 border-bottom row">
                    {{-- Data --}}
                    <div class="col-md-8">
                        <h5>{{ $movie->title }}</h5>
                        <p>{{ $movie->desc }}</p>
                    </div>
                    <div class="col-md-4 d-flex flex-row-reverse">
                        <div class="action d-flex">
                            {{-- Detail --}}
                            @can('movies.show')
                            <div>
                                <a 
                                    href="{{ route('movies.show', $movie) }}" 
                                    class="btn btn-sm btn-info mr-2"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            @endcan
                            {{-- Edit --}}
                            @can('movies.edit')
                            <div>
                                <a 
                                    href="{{ route('movies.edit', $movie) }}" 
                                    class="btn btn-sm btn-success mr-2"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            @endcan
                            {{-- Delete --}}
                            @can('movies.delete')
                            <form 
                                action="{{ route('movies.destroy', $movie) }}" 
                                method="POST" 
                                role="alert"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
        @if ($movies->hasPages())
        <div class="card-footer">
            {{ $movies->links('vendor.pagination.bootstrap-4') }}
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