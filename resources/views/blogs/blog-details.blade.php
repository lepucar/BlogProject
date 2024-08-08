@extends('blogs.blogmaster')

@section('body')

<div class="mb-3">
    <a href="{{route('editBlog',$singleBlog->id)}}">
        <button class="btn btn-success">
            Edit
        </button>
    </a>

    <a href="{{route('deleteBlog',$singleBlog->id)}}">
        <button class="btn btn-danger">
            Delete
        </button>
    </a>
</div>



<div class="news-display">
    
    <div class="mb-3">
        <h1>{{$singleBlog->title}}</h1>
    </div>

    <div class="mb-3">

        @if ($singleBlog->image)
        <img src="{{url($singleBlog->image)}}" alt="" height="400px">
        @endif
        <p>{{$singleBlog->description}}</p>
        <p>By: {{$singleBlog->name}}</p>


    </div>




</div>

@endsection