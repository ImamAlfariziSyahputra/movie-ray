@extends('layouts.dashboard')

@section('title')
Add Cast
@endsection

@section('bc')
{{ Breadcrumbs::render('addCast') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('casts.store') }}" method="POST">
                    @csrf
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
                    {{-- <div class="form-group">
                        <label for="image" class="font-weight-bold">
                            Image
                        </label>
                        <div class="custom-file">
                            <input 
                                type="file" 
                                class="custom-file-input" 
                                name="image" 
                                id="image" 
                                data-preview="holder"
                                data-input="thumbnail"
                            >
                            <label class="custom-file-label" for="image">Choose file...</label>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            Image
                        </label>
                        <div class="input-group mb-3">
                            <span class="input-group-btn">
                                <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fas fa-images"></i> Choose
                                </button>
                            </span>
                            <input 
                                id="thumbnail"
                                value="{{ old('image') }}"
                                class="form-control @error('image') is-invalid @enderror"
                                type="text"
                                name="image"
                                readonly
                            >
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    {{-- img preview --}}
                    <div id="holder" class="mb-3">
                    </div>
                    <div class="float-right">
                        <a href="{{ route('casts.index') }}" class="btn btn-warning text-white">
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

@push('custJs')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $(() => {
        $('#lfm').filemanager('image');
    });
</script>
@endpush

@endsection