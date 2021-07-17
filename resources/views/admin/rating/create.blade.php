@extends('layouts.dashboard')

@section('title')
Add Rating
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="number" class="font-weight-bold">
                            Number
                        </label>
                        <input type="email" class="form-control" id="number" placeholder="Enter number...">
                    </div>
                    <div class="float-right">
                        <div class="btn btn-warning text-white">
                            Back
                        </div>
                        <div class="btn btn-primary">
                            Submit
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection