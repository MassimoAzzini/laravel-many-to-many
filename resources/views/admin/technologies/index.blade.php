@extends('layouts.admin')

@section('content')

    <h1 class="fw-bold">Index Technologies</h1>

    <form class="col-5" action="{{ route('admin.technologies.store') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="New Tecnology" name="name">
            <input type="text" class="form-control" placeholder="Link documantation" name="link">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Create</button>
        </div>
    </form>

    <table class="table table-dark w-75">
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

                        <button onclick="startEdit({{ $technology->id }})" class="btn btn-warning">Edit</button>
                        @include('admin.partials.btnDelate', [
                            'route' => route('admin.technologies.destroy', $technology),
                            'message' => 'Are you sure you want to delete this technology?',
                        ])

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function submitForm(id) {
            const form = document.getElementById('form-edit-' + id);
            form.submit();

            const name = document.getElementById('name-' + id);
            form.classList.add('d-none');
            name.classList.remove('d-none');
        }


        function startEdit(id) {
            const form = document.getElementById('form-edit-' + id);
            const name = document.getElementById('name-' + id);

            form.classList.remove('d-none');
            name.classList.add('d-none');
        }

    </script>

@endsection
