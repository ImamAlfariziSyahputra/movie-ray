@extends('layouts.dashboard')

@section('title')
Directors
@endsection

@section('bc')
{{ Breadcrumbs::render('director') }}
@endsection

@section('content')

<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-header d-flex justify-content-between no-gutters">
            <div class="col-md-6">
                <form action="{{ route('directors.index') }}" method="GET" class="">
                    <div class="input-group">
                        <input class="form-control" type="text" name="keyword" value="{{ request()->get('keyword') }}"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('directors.create') }}" class="btn btn-primary">
                    Add
                    <i class="fa fa-plus-square"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                @foreach ($directors as $director)
                <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                    {{-- Data --}}
                    <div>
                        {{ $director->name }}
                    </div>
                    <div class="action d-flex">
                        {{-- Detail --}}
                        <button 
                            class="btn btn-sm btn-info mr-2"
                            data-toggle="modal"
                            data-target="#detailModal"
                            data-director='{{ $director }}'
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                        {{-- Edit --}}
                        <a href="{{ route('directors.edit', $director) }}" class="btn btn-sm btn-success mr-2">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        {{-- Delete --}}
                        <form action="{{ route('directors.destroy', $director) }}" method="POST" role="alert">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if ($directors->hasPages())
        <div class="card-footer">
            {{ $directors->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLabel">
                    Detail Directors
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex">
                <div class="col-md-5 mr-3 wrapper-img">
                    <img 
                        src=""
                        alt=""
                        class="img-fluid"
                        id="director-img"
                    >
                </div>
                <div class="col-md-7 flex-column">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td id="director-name"></td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>:</td>
                            <td>unknown</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('custCss')
<style>
.modal img {
    max-height: 15rem;
    border-radius: 0.5rem;
}
</style>
@endpush

@push('custJs')
<script>
$(() => {
    $('form[role="alert"]').submit((e) => {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });

    $('#detailModal').on('shown.bs.modal', (e) => {
        var button = $(e.relatedTarget) //button that triggered modal
        var director = button.data('director');

        $('#director-img').attr({
            'src': director.image,
            'alt': director.name,
        });
        $('#director-name').text(director.name);
    });

    // Refresh Modal
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('#detailModal').removeData('bs.modal')
    // });
});
</script>
@endpush

@endsection