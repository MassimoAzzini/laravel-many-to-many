@extends('layouts.admin')

@section('content')
<div class="container bg-dark text-white p-5 opacity-75">

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span class="text-white me-3 fw-bold fs-4">Name Project: </span>
            <h1 class="fw-bold text-capitalize"> {{ $project->name }}</h1>
        </div>

        <div>
            <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
            @include('admin.partials.btnDelate', [
                'route' => route('admin.projects.destroy', $project),
                'message' => 'Are you sure you want to delete this project?'
                ])
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Index</a>
        </div>
    </div>

    <div class="row my-4">
        <div class="col">
            <strong>Start Project: </strong> <span>{{ $project->start_project }}</span>
        </div>
        <div class="col">
            <strong>End Project: </strong>

            @if ($project->end_project)
                <span>{{ $project->end_project }}</span>
            @else
                <span>Project still in progress</span>
            @endif

        </div>

        <div class="col">
            <strong>Technology: </strong>
                @forelse ($project->technologies as $technology)
                    <a href="{{ route('admin.project-technology', $technology) }}" class="badge text-bg-info text-decoration-none">{{ $technology->name }}</a>
                @empty
                -
                @endforelse

        </div>

        <div class="col">
            <strong>Link Project: </strong> <a href="{{ $project->url }}"> Project link </a>
        </div>
    </div>

    <div>
        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->image_original_name }}">
    </div>


    <p>
        <strong>Description Project: </strong>{{ $project->description }}
    </p>
</div>



@endsection
