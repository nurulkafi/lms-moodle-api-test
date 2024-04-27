@extends('layouts.master')
@section('content')
<div class="row justify-content-center">
    <form action="{{ url('/course/store') }}" method="post">
    @csrf
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Course</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="basicInput">Name</label>
                    <input type="text" class="form-control" name="name" id="basicInput" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="helpInputTop">Description</label>
                    <textarea class="form-control" id="helpInputTop" placeholder="Enter Description" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="helperText">Category</label>
                    <select class="form-select" name="category_id" id="helperText" >
                        @foreach ($category as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="float-end mt-3">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
