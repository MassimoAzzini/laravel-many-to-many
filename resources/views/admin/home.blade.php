@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="cont-dash-projects bg-dark opacity-75">
            <h2 class="fw-bold">Index Projects</h2>

            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Name Project</th>
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
                            <td>{{ $project->short_description }}</td>
                            <td>
                                @forelse ($project->technologies as $technology)
                                <a href="{{ route('admin.project-technology', $technology) }}" class="badge text-bg-info text-decoration-none">{{ $technology->name }}</a>
                                @empty
                                -
                                @endforelse
                            </td>
                            <td>{{ $project->type->name }}</td>
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

        </div>
    </div>

    <div class="row row-cols-2 d-flex justify-content-between">
{{-- TECHNOLOGIES --}}
        <div class="cont-dash-technologies bg-dark opacity-75 col-6 overflow-auto">
            <h2 class="fw-bold">Index Technologies</h2>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Name Technologies</th>
                        <th class="col-1 text-center" scope="col">Documentation</th>
                        <th class="col-2 text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($technologies as $technology)
                    <tr>
                        <td>

                            <form
                              class="d-none"
                              action="{{ route('admin.technologies.update', $technology) }}"
                              method="POST"
                              id="form-edit-{{ $technology->id }}">
                              @csrf
                              @method('PUT')
                              <input type="text" class="form-cst w-25" value="{{ $technology->name }}" name="name">

                              <input type="text" class="w-50" value="{{ $technology->link }}" name="link">

                              <button onclick="submitForm({{ $technology->id }})" class="btn btn-warning">Send</button>
                            </form>
                            <span id="name-{{ $technology->id }}" class="">{{ $technology->name }}</span>

                        </td>

                        <td>
                            @if ( $technology->link )
                                <a class="btn btn-info" href="{{ $technology->link }}" target="_blank">Documentation</a>
                            @endif
                        </td>

                        <td class="d-flex justify-content-around">

                            <button onclick="startEdit({{ $technology->id }})" class="btn btn-warning me-2">Edit</button>
                            @include('admin.partials.btnDelate', [
                                'route' => route('admin.technologies.destroy', $technology),
                                'message' => 'Are you sure you want to delete this technology?',
                            ])

                        </td>
                    </tr>
                @endforeach
                    </tbody>
            </table>
        </div>

{{-- TYPE --}}
        <div class="cont-dash-types bg-dark opacity-75 col-5 overflow-auto">
            <h2 class="fw-bold">Index Types</h2>

            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Name Types</th>
                    <th class="col-2 text-center" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($types as $type)
                        <tr>
                            <td>

                                <form
                                  class="d-none"
                                  action="{{ route('admin.types.update', $type) }}"
                                  method="POST"
                                  id="form-edit-{{ $type->id }}">
                                  @csrf
                                  @method('PUT')
                                  <input type="text" class="form-cst w-25" value="{{ $type->name }}" name="name">

                                  <button onclick="submitForm({{ $type->id }})" class="btn btn-warning">Send</button>
                                </form>
                                <span id="name-{{ $type->id }}" class="">{{ $type->name }}</span>

                            </td>

                            <td class="d-flex justify-content-around">

                                <button onclick="startEdit({{ $type->id }})" class="btn btn-warning me-2">Edit</button>
                                @include('admin.partials.btnDelate', [
                                    'route' => route('admin.types.destroy', $type),
                                    'message' => 'Are you sure you want to delete this type?',
                                ])

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
