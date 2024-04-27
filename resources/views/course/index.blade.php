@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="float-start">
                <a href="{{ url('/course/create') }}" class="btn btn-success">Create +</a>
            </div>
        </div>
        <form action="{{ url('/course/search') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-11">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" id="search"
                            placeholder="Search By ID or Name">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        @forelse ($data as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <img class="card-img-bottom img-fluid" src="https://placehold.co/400" alt="Card image cap"
                            style="height: 20rem; object-fit: cover;">
                        <div class="card-body">
                            <h4 class="card-title">{{ $item['name'] }}</h4>
                            <p class="card-text">
                                {{ $item['description'] }}

                            </p>
                            <p>Instructor : @if (count($item['instructors']) > 0)
                                    @foreach ($item['instructors'] as $instructor)
                                        <ul>
                                            <li>{{ $instructor }}</li>
                                        </ul>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </p>
                            <p>Total Students : {{ $item['total_students'] }}</p>
                            <a href="#" class="card-link"><small>Show More</small></a>
                        </div>
                        <div class="btn-group align-items-center mx-2 px-1">
                            <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                                <i class="bi bi-heart d-flex align-items-center justify-content-center text-secondary"></i>
                            </button>
                            <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                                <i class="bi bi-chat d-flex align-items-center justify-content-center text-secondary"></i>
                            </button>
                            <button type="button" class="btn btn-link p-2 m-1 text-decoration-none">
                                <i
                                    class="bi bi-bookmark d-flex align-items-center justify-content-center text-secondary"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        Data Not Found
        @endforelse
    </div>
@endsection
