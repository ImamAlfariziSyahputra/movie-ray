@extends('layouts.dashboard')

@section('title')
Rating
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-header d-flex justify-content-between no-gutters">
            <div class="col-md-6">
                <form action="" method="GET" class="">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('ratings.create') }}" class="btn btn-primary">
                    Add
                    <i class="fa fa-plus-square"></i>
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="">
                @foreach ($ratings as $rating)
                <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                    <div>
                        {{$rating->number}}
                    </div>
                    <div class="action">
                        {{-- Edit --}}
                        <a href="#" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        {{-- Delete --}}
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

</div>

@endsection