@extends('layouts.admin')

@section('content')
<div class="container bg-dark opacity-75">


<h1 class="fw-bold">{{ $title }}</h1>

@if($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif

<form action="{{ $route }}" method="POST" class="row g-3 create-edit-form" enctype="multipart/form-data">

    @csrf
    @method($method)
    <div class="col-12">
        <label for="name" class="form-label">Name Project</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project?->name) }}">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>
    <div class="col-4">
        <label for="start_project" class="form-label">Start Project</label>
        <input type="date" class="form-control @error('start_project') is-invalid @enderror" id="start_project" name="start_project" value="{{ old('start_project', $project?->start_project) }}">
        @error('start_project')
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>
    <div class="col-4">
        <label for="end_project" class="form-label">End Project</label>
        <input type="date" class="form-control @error('end_project') is-invalid @enderror" id="end_project" name="end_project" value="{{ old('end_project', $project?->end_project) }}">
        @error('end_project')
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>
    <div class="col-4">
        <label for="type_id" class="form-label">Type</label>
        <select name="type_id" class="form-select" id="type_id" >
            <option value="">Select Type</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" @if ($type->id === old('type_id', $project?->type?->id)) selected @endif>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label for="url" class="form-label">Link Project</label>
        <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $project?->url) }}">
        @error('url')
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>
    <div class="col-12">
        <label for="short_description" class="form-label">Short Description</label>
        <input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" value="{{ old('short_description', $project?->short_description) }}">
        @error('short_description')
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>

    <div class="col-12">
        @foreach ($technologies as $technology)

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input
                  type="checkbox"
                  class="btn-check"
                  id="technology_{{ $technology->id }}"
                  autocomplete="off"
                  name="technologies[]"
                  value="{{ $technology->id }}"
                  @if ($project?->technologies->contains($technology->id)) checked @endif>
                <label class="btn btn-outline-primary" for="technology_{{ $technology->id }}">{{ $technology->name}}</label>
            </div>

        @endforeach
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description', $project?->description) }}">
        @error('description')
            <p class="text-danger">{{ $message }}</p>
        @enderror

    </div>

    <div class="col-5">
        <label for="image" class="form-label">Image</label>
        <input
          id="image"
          class="form-control @error('image') is-invalid @enderror"
          name="image"
          type="file"
          onchange="showImage(event)"
          value="{{ old('image', $project?->image) }}"
        >
        @error('image')
            <p class="text-danger">{{ $image }}</p>
        @enderror

        <img class="mt-3" id="thumb" width="150" onerror="this.src='/img/placeholder.jpg'"  src="{{ asset('storage/' . $project?->image) }}" />

    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Send</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <a class="btn btn-info" href="{{ route('admin.projects.index') }}">List Project</a>
    </div>
</form>

</div>


<script>
    function showImage(event){
        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }
</script>


@endsection
