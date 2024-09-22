@extends('frontend.layout.body')

@section('content')

<div class="bg-color min-vh-89">

<div class="text-center pt-5 pb-4">
    <h2><span class="primarycolor">Upload</span> Post</h2>
</div>

<div class="container">
    <div class="row justify-content-center text-center">
    <form method="POST" action="{{route('frontend.uploadpost')}}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="" name="name">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Description</label>
                <textarea class="" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="video">Video Upload</label>
                <input type="file" class="" name="video">
            </div>
            <div class="mb-3">
                <label for="image">Image Upload</label>
                <input type="file" class="" name="image">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" class="">
                    @foreach($categories as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
    </div>
</div>

</div>
@endsection
