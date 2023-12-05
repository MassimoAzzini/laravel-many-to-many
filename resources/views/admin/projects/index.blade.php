@extends('layouts.admin')

@section('content')

    <h1 class="fw-bold">Index Projects</h1>

    <a class="btn btn-secondary text-end my-2" href="{{ route('admin.projects.create') }}">New Project</a>

    <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">
                <a class="text-decoration-none" href="{{ route('admin.order-by', ['direction'=>$direction, 'column'=>'name']) }}">Name Project</a>
            </th>
            <th scope="col">
                <a class="text-decoration-none" href="{{ route('admin.order-by', ['direction'=>$direction, 'column'=>'start_project']) }}">Start Project</a>
            </th>
            <th scope="col">Short Description</th>
            <th scope="col">Technology</th>
            <th scope="col">Type</th>
            <th scope="col">Link</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->start_project }}</td>
                    <td>{{ $project->short_description }}</td>

                    <td>
                    @forelse ($project->technologies as $technology)
                    <a href="{{ route('admin.project-technology', $technology) }}" class="badge text-bg-info text-decoration-none">{{ $technology->name }}</a>

                    @empty
                    -
                    @endforelse

                    </td>

                    <td>{{ $project->type?->name ?? '-' }}</td>
                    <td><a href="{{ $project->url }}" target="_blank">Project link</a></td>
                    <td>
                        <a class="btn btn-success" href="{{ route('admin.projects.show', $project) }}">Details</a>
                        <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                        @include('admin.partials.btnDelate', [
                            'route' => route('admin.projects.destroy', $project),
                            'message' => 'Are you sure you want to delete this project?'
                            ])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}

@endsection
