@extends('layouts.dashboard')

@section('title')
Detail Cast
@endsection

@section('bc')
{{ Breadcrumbs::render('detailCast', $cast) }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="d-flex flex-wrap">
                <div class="wrapper-img pr-4 col-md-4">
                    <img
                        src="{{ $cast->image }}"
                        alt="{{ $cast->name }}"
                        class="img-fluid"
                    >
                </div>
                <div class="col-md-8">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $cast->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="float-right mt-2">
                <a href="{{ route('casts.index') }}" class="btn btn-warning text-white">
                    Back
                </a>
            </div>
        </div>
    </div>

</div>

@push('custCss')
<style>
img {
    max-height: 15rem;
}
td {
    font-size: 2rem;
}
</style>
@endpush

@endsection