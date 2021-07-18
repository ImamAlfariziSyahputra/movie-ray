@extends('layouts.dashboard')

@section('title')
Edit Director
@endsection

@section('bc')
{{ Breadcrumbs::render('editDirector', $director) }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('directors.update', $director) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                            value="{{ old('name', $director->name) }}"
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

                    {{-- Preview Image --}}
                    {{-- <div class="preview-img col-md-4 p-0 mb-3">
                        <img 
                            src="{{ $director->image }}"
                            alt="{{ $director->name }}"
                            class="img-fluid"
                        >
                    </div> --}}

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

@push('custCss')
<style>
.preview-img img {
    max-height: 10rem;
    border-radius: 0.4rem
}
</style>
@endpush

@push('custJs')
<script>
    $(() => {
        $('.custom-file-label').text('{{ explode('/', $director->image)[3] }}')

        $('#image').on('change', (e) => {
            $('#image').removeClass('is-invalid');
            var fileName = e.target.files[0].name;
            // replace to fileName
            $('.custom-file-label').html(fileName);
        })
    })
</script>
@endpush