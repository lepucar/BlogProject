@extends('components.master')

@section('body')

<h1>User Register</h1>

<form method="post" action="{{route('editBlog', $blog->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title
        <span class="text-danger">{{$errors->first('title')}}</span>
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{$blog->title}}">
        
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description
            <span class="text-danger">{{$errors->first('description')}}</span>
        </label>
        <textarea class="form-control" id="textareaDesc" name="description" >{{$blog->description}}</textarea>
        
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image
            <span class="text-danger">{{$errors->first('image')}}</span>
        </label>
        <input type="file" name="image" class="form-control">
        
    </div>



    

    <div class="mb-3">
        <button class="btn btn-primary">Edit Blog</button>
    </div>

    

</form>


@endsection