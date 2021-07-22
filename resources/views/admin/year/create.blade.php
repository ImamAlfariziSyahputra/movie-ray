@extends('layouts.dashboard')

@section('title')
Add Year
@endsection

@section('bc')
{{ Breadcrumbs::render('addYear') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="{{ route('years.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            Name
                        </label>
                        <input 
                            type="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}"
                            placeholder="Enter name..."
                        >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="float-right">
                        <a href="{{ route('years.index') }}" class="btn btn-warning text-white">
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