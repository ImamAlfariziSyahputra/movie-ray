@extends('layouts.dashboard')

@section('title')
File Manager
@endsection

@section('bc')
{{ Breadcrumbs::render('fileManager') }}
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <form action="{{ route('fileManager.index') }}" method="GET" style="width: 200px">
                <div class="input-group">
                    <select name="type" class="custom-select">
                        @foreach ($types as $key => $value)
                        <option 
                            value="{{ $key }}"
                            {{ $typeSelected == $key ? 'selected' : null}} 
                            >
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            Apply
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <iframe src="{{ route('unisharp.lfm.show') }}?type={{ $typeSelected }}" style="width: 100%; height: 600px; overflow: hidden; border: none;"></iframe>
        </div>
    </div>
</div>

@endsection