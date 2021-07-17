@extends('layouts.dashboard')

@section('title')
Add Genre
@endsection

@section('bc')
{{ Breadcrumbs::render('addGenre') }}
@endsection

@section('content')
<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('genres.store') }}" method="POST">
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