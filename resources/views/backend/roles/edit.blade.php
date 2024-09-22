@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit roles</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('roles.update', ['id' => $role->id])}}">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$role->name}}">
            </div>
            <div class="mb-3">
                <label for="permissions" class="form-label">Permissions</label>
                <select name="permissions[]" class="form-select" multiple>
                    @foreach($permissions as $p)
                    <option value="{{ $p->name }}" {{ in_array($p->id, $selectedPermissionsIds) ? 'selected' : '' }}>
                        {{$p->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
@endsection
