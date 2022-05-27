@extends('layouts.app')

@section('upload')

    @if (session('status'))
        <h4 class="alert alert-success">{{ session('status') }}</h4>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Add image</label>
                                <input type="file" name="add_image" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Save Image(s)</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
