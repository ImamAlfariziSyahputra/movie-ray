@extends('layouts.dashboard')

@section('title')
Add Rating
@endsection

@section('bc')
{{ Breadcrumbs::render('addRating') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('ratings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="number" class="font-weight-bold">
                            Number
                        </label>
                        <input 
                            type="number" 
                            class="form-control @error('number') is-invalid @enderror" 
                            name="number" 
                            id="number" 
                            value="{{ old('number') }}"
                            placeholder="Enter number..."
                        >
                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="float-right">
                        <a href="{{ route('ratings.index') }}" class="btn btn-warning text-white">
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