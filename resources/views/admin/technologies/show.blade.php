@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Technologies Show</h1>
        <div class="row">
            @forelse ($technology->projects as $project)
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card">
                        <div class="card">
                            <div class="card-body my-150h w-100">
                                <img class="w-100 my-150h" src="{{ $project->image }}" alt="{{ $project->name }}">
                            </div>
                            <div class="card-body">
                                <h3 class="text-uppercase card-title py-3">{{ $project->name }}</h3>
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <a class="btn btn-primary"
                                    href="{{ route('admin.projects.show', $project->slug) }}">Details</a>
                                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' class="delete-button border-0"
                                        data-item-title="{{ $project->name }}"> <i
                                            class="fa-solid fa-trash fs-1 text-danger me-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">There isn't any project of this technology</div>
            @endforelse
        </div>
    </div>
@endsection
