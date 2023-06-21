@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <img class="img-fluid" src="{{ $project->image }}" alt="{{ $project->name }}">
            </div>
            <div class="card-body">
                <h3 class="text-uppercase card-title py-3">{{ $project->name }}</h3>
                @if($project->type_id)
                    <div>Project type: <span class="text-uppercase">{{$project->type->name}}</span></div>
                @endif
                <a class="btn btn-primary" href="{{ $project->url }}">View GitHub</a>
                <p class="card-text">{!! $project->description !!}</p>
            </div>
            @if($project->technologies)
            <div class="card-body text-danger">
                 @foreach ($project->technologies as $technology)
                <span class="badge rounded-pill text-bg-primary">{{$technology->name}}</span>
                @endforeach
            </div>
            @endif
            <div class="card-body d-flex justify-content-between">
                <a href="{{ route('admin.projects.edit', $project->slug) }}"><i class="fa-solid fs-1 fa-pencil me-1"></i></a>
                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type='submit' class="delete-button border-0" data-item-title="{{ $project->name }}"> <i
                            class="fa-solid fa-trash fs-1 text-danger me-1"></i></button>
                </form>
            </div>
        </div>
    </div>
    @include('partials.delete_modal')
@endsection
