@extends('layouts.admin')

@section('content')
    <h1 class="text-danger">Index technologies</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="container">
        <table class="table pb-3 m-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="d-none d-sm-block">Created</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->id }}</th>
                        <td id="td-name-edit">{{ $technology->name }}</td>
                        {{-- Form for edit --}}
                        <td id="td-form-edit" class="d-none">
                            <form action="{{ route('admin.technologies.update', $technology->slug) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 input-group">
                                    <input type="text" class="input-group-text @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required>
                                    <button id="submit-edit" type="submit" class="btn btn-primary">Edit</button>
                                    @error('name')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </form>
                        </td>
                        {{-- End editing --}}
                        <td class="d-none d-sm-table-cell">{{ $technology->created_at }}</td>
                        <td>
                            <a class="text-dark-blue" href="{{ route('admin.technologies.show', $technology->slug) }}"><i
                                    class="fa-solid fa-eye me-2"></i></a>
                            <a class="text-dark-blue pencil-edit" href="#"><i class="fa-solid fa-pencil me-2"></i></a>
                            <form class="d-inline-block"
                                action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button technology='submit' class="delete-button border-0"
                                    data-item-title="{{ $technology->name }}"> <i
                                        class="fa-solid fa-trash text-danger me-1"></i></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Form for store --}}
        <form action="{{ route('admin.technologies.store') }}" method="POST">
            @csrf
            <div class="mb-3 input-group">
                <input type="text" class="input-group-text @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" required>
                <button type="submit" class="btn btn-primary">Add Technology</button>
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </form>
    </div>
    @include('partials.delete_modal')
@endsection
