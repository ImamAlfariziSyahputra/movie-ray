@extends('layouts.dashboard')

@section('title')
Year
@endsection

@section('bc')
{{ Breadcrumbs::render('year') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-header d-flex justify-content-between no-gutters">
            <div class="col-md-6">
                <form action="{{ route('years.index') }}" method="GET" class="">
                    <div class="input-group">
                        <input 
                            class="form-control" 
                            type="number" 
                            name="keyword"
                            value="{{ request()->get('keyword') }}"
                            placeholder="Search for..." 
                            aria-label="Search"
                            aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            @can('years.create')
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('years.create') }}" class="btn btn-primary">
                    Add
                    <i class="fa fa-plus-square"></i>
                </a>
            </div>
            @endcan
        </div>
        <div class="card-body">

            <div class="">
                {{-- Data --}}
                @foreach ($years as $year)
                <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                    <div>
                        {{ $year->name }}
                    </div>
                    <div class="action d-flex">
                        @can('years.edit')
                        {{-- Edit --}}
                        <a href="{{ route('years.edit', $year) }}" class="btn btn-sm btn-success mr-2">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        {{-- Delete --}}
                        @can('years.delete')
                        <form 
                            action="{{ route('years.destroy', $year) }}" 
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
                @endforeach
            </div>

        </div>
        @if ($years->hasPages())
            <div class="card-footer">
                {{ $years->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>

</div>

@endsection

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