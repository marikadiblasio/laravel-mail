@extends('layouts.admin')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<h1 class="text-white py-3">Index Project</h1>
<table class="table pb-3">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Type</th>
        <th scope="col" class="d-none d-sm-block">Created</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ( $projects as $project)
            <tr>
                <th scope="row">{{ $project->id}}</th>
                <td>{{ $project->name}}</td>
                <td><img class="my-table-img img-thumbnail" src="{{ $project->image}}" alt="{{ $project->name}}"></td>
                <td>{{$project->type_id ? $project->type->name : 'Unselected'}}</td>
                <td  class="d-none d-sm-table-cell">{{ $project->created_at}}</td>
                <td>
                    <a class="text-dark-blue" href="{{route('admin.projects.show', $project->slug)}}"><i class="fa-solid fa-eye me-2"></i></a>
                    <a class="text-dark-blue" href="{{route('admin.projects.edit', $project->slug)}}"><i class="fa-solid fa-pencil me-2"></i></a>
                    <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="delete-button border-0" data-item-title="{{ $project->name }}"> <i
                                class="fa-solid fa-trash text-danger me-1"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
  {{$projects->links('vendor.pagination.bootstrap-5')}}
  @include('partials.delete_modal')
@endsection
