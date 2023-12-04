@extends('layouts.admin')

@section('content')

    <h1 class="fw-bold">Index Types</h1>

    <form class="col-5" action="{{ route('admin.types.store') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="New Type" name="name">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Create</button>
        </div>
    </form>

    <table class="table table-dark w-75">
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

                        <button onclick="startEdit({{ $type->id }})" class="btn btn-warning">Edit</button>
                        @include('admin.partials.btnDelate', [
                            'route' => route('admin.types.destroy', $type),
                            'message' => 'Are you sure you want to delete this type?',
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
