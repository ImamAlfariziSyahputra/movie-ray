@extends('layouts.dashboard')

@section('title')
Edit Movie
@endsection

@section('bc')
{{ Breadcrumbs::render('editMovie', $movie) }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('movies.update', $movie) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Director -->
                    <div class="form-group">
                        <label for="director" class="font-weight-bold">
                            Director
                        </label>
                        <select 
                            class="form-control border @error('director') is-invalid @enderror"
                            data-placeholder='Choose'
                            name="director"
                            id="director"
                        >
                            @if (old('director', $movie->director))
                                <option value="{{ old('director', $movie->director)->id }}" selected>
                                    {{ old('director', $movie->director)->name }}
                                </option>
                            @endif
                        </select>
                        @error('director')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">
                            Title
                        </label>
                        <input 
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            name="title"
                            id="title"
                            value="{{ old('title', $movie->title) }}"
                            placeholder="Enter title..."
                            autocomplete="off"
                        >
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Slug --}}
                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">
                            Slug
                        </label>
                        <input 
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            name="slug"
                            id="slug"
                            value="{{ old('slug', $movie->slug) }}"
                            placeholder="Auto generate..."
                            readonly
                        >
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- {{dd($movie->genre)}} --}}
                    {{-- Genres --}}
                    <div class="form-group">
                        <label for="genres">Select genres</label>
                        <select 
                            class="form-control @error('genres') is-invalid @enderror" 
                            data-placeholder='Choose' 
                            name="genres[]" 
                            id="genres" 
                            multiple
                        >
                            @if (old('genres', $movie->genre))
                                @foreach (old('genres', $movie->genre) as $genre)
                                    <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('genres')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Banner --}}
                    <div class="form-group">
                        <label for="banner" class="font-weight-bold">
                            Banner
                        </label>
                        <div class="input-group mb-3">
                            <span class="input-group-btn">
                                <button id="banner" data-input="banner-img" data-preview="banner-holder" class="btn btn-primary">
                                <i class="fas fa-images"></i> Choose
                                </button>
                            </span>
                            <input 
                                id="banner-img"
                                value="{{ old('banner', $movie->banner) }}"
                                class="form-control @error('banner') is-invalid @enderror"
                                type="text"
                                name="banner"
                                readonly
                            >
                            @error('banner')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div id="banner-holder">
                        
                    </div>
                    {{-- Poster --}}
                    <div class="form-group">
                        <label for="poster" class="font-weight-bold">
                            Poster
                        </label>
                        <div class="input-group mb-3">
                            <span class="input-group-btn">
                                <button id="poster" data-input="poster-img" data-preview="poster-holder" class="btn btn-primary">
                                    <i class="fas fa-images"></i> Choose
                                </button>
                            </span>
                            <input 
                                id="poster-img"
                                value="{{ old('poster', $movie->poster) }}"
                                class="form-control @error('poster') is-invalid @enderror"
                                type="text"
                                name="poster"
                                readonly
                            >
                            @error('poster')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div id="poster-holder">
                        
                    </div>
                    {{-- Desc --}}
                    <div class="form-group">
                        <label for="desc" class="font-weight-bold">Description</label>
                        <textarea 
                            class="form-control @error('desc') is-invalid @enderror"
                            name="desc"
                            id="desc"
                            rows="3"
                        >{{ old('desc', $movie->desc) }}</textarea>
                        @error('desc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Synopsis --}}
                    <div class="form-group">
                        <label for="synopsis" class="font-weight-bold">Synopsis</label>
                        <textarea 
                            name="synopsis" 
                            class="form-control my-editor @error('synopsis') is-invalid @enderror"
                            rows="15"
                        >{{ old('synopsis', $movie->synopsis) }}</textarea>
                        @error('synopsis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Casts --}}
                    <div class="form-group">
                        <label for="casts">Select casts</label>
                        <select 
                            class="form-control @error('casts') is-invalid @enderror" 
                            data-placeholder='Choose' 
                            name="casts[]" 
                            id="casts" 
                            multiple
                        >
                            @if (old('casts', $movie->cast))
                                @foreach (old('casts', $movie->cast) as $cast)
                                    <option value="{{ $cast->id }}" selected>
                                        {{ $cast->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('casts')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Trailer --}}
                    <div class="form-group">
                        <label for="trailer" class="font-weight-bold">
                            Trailer
                        </label>
                        <input 
                            type="text"
                            class="form-control @error('trailer') is-invalid @enderror"
                            name="trailer"
                            id="trailer"
                            value="{{ old('trailer', $movie->trailer) }}"
                            placeholder="Enter trailer..."
                        >
                        @error('trailer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Year --}}
                    <div class="form-group">
                        <label for="year" class="font-weight-bold">
                            Year
                        </label>
                        <input 
                            type="number"
                            class="form-control @error('year') is-invalid @enderror"
                            name="year"
                            id="year"
                            value="{{ old('year', $movie->year) }}"
                            placeholder="Enter year..."
                        >
                        @error('year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Duration --}}
                    <div class="form-group">
                        <label for="duration" class="font-weight-bold">
                            Duration
                        </label>
                        <input 
                            type="number"
                            class="form-control @error('duration') is-invalid @enderror"
                            name="duration"
                            id="duration"
                            value="{{ old('duration', $movie->duration) }}"
                            placeholder="Enter duration..."
                        >
                        @error('duration')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- IMDB Rating --}}
                    <div class="form-group">
                        <label for="imdb_rating" class="font-weight-bold">
                            IMDB Rating
                        </label>
                        <input 
                            type="number"
                            class="form-control @error('imdb_rating') is-invalid @enderror"
                            name="imdb_rating"
                            id="imdb_rating"
                            value="{{ old('imdb_rating', $movie->imdb_rating) }}"
                            placeholder="Enter imdb_rating..."
                        >
                        @error('imdb_rating')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Action --}}
                    <div class="float-right">
                        <a href="{{ route('movies.index') }}" class="btn btn-warning text-white">
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

<style>
#banner-holder img, #poster-holder img {
    border-radius: 0.5rem;
}
</style>
@endpush

@push('custJs')

{{-- lfm standalone btn --}}
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
{{-- TinyMCE5 --}}
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{asset('vendor/select2/js/select2.min.js') }}"></script>

<script>
$(() => {
    $("#title").keyup(function (event) {
        $("#slug").val(
            event.target.value
            .trim()
            .toLowerCase()
            .replace(/[^a-z\d-]/gi, "-")
            .replace(/-+/g, "-")
            .replace(/^-|-$/g, "")
        );
    });

    $('#banner').filemanager('image');
    $('#poster').filemanager('image');


    // TinyMCE5
    var editor_config = {
        path_absolute : "/",
        selector: 'textarea.my-editor',
        relative_urls: false,
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
            callback(message.content);
            }
        });
        }
    };

    tinymce.init(editor_config);

    // Select2 Single : Directors
    $('#director').select2({
        theme: 'bootstrap4',
        language: "{{ app()->getLocale() }}",
        allowClear: true,
        ajax: {
            url: "{{ route('directors.select') }}",
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

    // Select2 Multiple : Casts
    $('#casts').select2({
        theme: 'bootstrap4',
        language: "{{ app()->getLocale() }}",
        allowClear: true,
        ajax: {
            url: "{{ route('casts.select') }}",
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

    // Select2 Multiple : Genres
    $('#genres').select2({
        theme: 'bootstrap4',
        language: "{{ app()->getLocale() }}",
        allowClear: true,
        ajax: {
            url: "{{ route('genres.select') }}",
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