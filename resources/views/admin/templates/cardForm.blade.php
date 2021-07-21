<div class="col-md-12 p-0">

    <div class="card">
        <div class="card-body">
            {{-- Content --}}
            <div class="">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="something" class="font-weight-bold">
                            Something
                        </label>
                        <input 
                            type="text"
                            class="form-control"
                            name="something"
                            id="something"
                            value=""
                            placeholder="Enter something..."
                        >
                    </div>
                    <div class="float-right">
                        <a href="" class="btn btn-warning text-white">
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