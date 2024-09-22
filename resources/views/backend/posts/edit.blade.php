@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit User Post</h2>
    </div>

    <div class="px-3 pb-3">
        <form method="POST" action="{{route('posts.update', ['slug' => $post->slug])}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$post->name}}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Description</label>
                <textarea class="form-control" name="description">{{$post->description}}</textarea>
            </div>
            <div class="mb-3">
                <label for="video">Video Upload</label>
                <input type="file" class="form-control" name="video">
                @if($post->video)
                    <video src="{{ asset('storage/videos/' . $post->video) }}" height="150" width="200" controls></video>
                @endif
            </div>
            <div class="mb-3">
                <label for="image">Image Upload</label>
                <input type="file" class="form-control" name="image">
                <br>
                @if($post->video)
                    <img src="{{ asset('storage/images/' . $post->image) }}" height="150" width="200">
                @endif
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $c)
                    <option value="{{$c->id}}" {{$c->id == $selectedcategory ? 'selected' : ''}} >{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="webuser_id" class="form-label">Select Webuser</label>
                <select name="webuser_id" class="form-select">
                    @foreach($webusers as $w)
                    <option value="{{$w->id}}" {{$w->id == $selectedwebuser ? 'selected' : ''}}>{{$w->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

@endsection