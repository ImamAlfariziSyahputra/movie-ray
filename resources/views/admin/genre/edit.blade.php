@extends('layouts.dashboard')

@section('title')
Edit Genre
@endsection

@section('bc')
{{ Breadcrumbs::render('editGenre', $genre) }}
@endsection

@section('content')
<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('genres.update', $genre) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            Name
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name"
                            id="name"
                            value="{{ old('name', $genre->name) }}"
                            placeholder="Enter name..."
                        >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="float-right">
                        <a href="{{ route('genres.index') }}" class="btn btn-warning text-white">
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