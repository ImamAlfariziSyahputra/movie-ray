@extends('layouts.dashboard')

@section('title')
Add Director
@endsection

@section('bc')
{{ Breadcrumbs::render('addDirector') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('directors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Inputs --}}
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
                    <div class="form-group">
                        <label for="image" class="font-weight-bold">
                            Image
                        </label>
                        <div class="custom-file">
                            <input 
                                type="file" 
                                class="custom-file-input @error('image') is-invalid @enderror" 
                                name="image" 
                                id="image" 
                            >
                            <label class="custom-file-label" for="image">Choose file...</label>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    {{-- Action --}}
                    <div class="float-right">
                        <a href="{{ route('directors.index') }}" class="btn btn-warning text-white">
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

@push('custJs')
<script>
    $(() => {
        $('#image').on('change', (e) => {
            $('#image').removeClass('is-invalid');
            var fileName = e.target.files[0].name;
            // replace to fileName
            $('.custom-file-label').html(fileName);
        })
    })
</script>
@endpush