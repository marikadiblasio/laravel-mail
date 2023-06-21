@extends('layouts.admin')

@section('content')
    <div class="text-white container">
        <h1>Create Project</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Project image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image') }}">
                @error('image')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Project github-url</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url"
                    value="{{ old('url') }}">
                @error('url')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Project type</label>
                <select class="form-control @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                    <option value="">Select the type of your project</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <p>Select Technologies</p>
                @foreach ($technologies as $technology)
                    <input class="form-check-input" type="checkbox" name="technologies[]" value="{{$technology->id}}"
                    {{in_array($technology->id, old('technologies', [])) ? 'checked' : ''}}>
                    <label class="form-check-label">{{$technology->name}}</label>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Project description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </form>
    </div>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
@endsection
