@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit User</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('assign.update', ['id' => $user->id])}}">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Role</label>
                <select name="role" class="form-control">
                    @foreach($roles as $r)
                    <option value="{{$r->name}}"
                    {{ $selectedrole == $r->name ? 'selected' : '' }}>
                        {{$r->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
@endsection
