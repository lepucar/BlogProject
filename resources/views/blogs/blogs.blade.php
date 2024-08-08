@extends('blogs.blogmaster')

@section('body')

<a href="{{route('addBlog')}}">
    <button class="btn btn-primary" id="btn add-blog">
        Add Blog
    </button>
</a>

<div class="blogs-list">
                
               
                @foreach($allBlogs as $blog)
                    
                    <div class="blogs-box">
                    
                         @if ($blog->image) 
                            <img src="{{url($blog->image)}}" alt="">
                         @endif
                       
                        <a href="{{route('blog-details',$blog->id)}}">
                            <h1>{{$blog->title}}</h1>
                        </a>

                        
                        
                        <a href="{{route('blog-details',$blog->id)}}" id="read-more">Read More</a><br>
                        <span id="user_span">By: {{$blog->user_name}}</span>
                        

                    </div>

                @endforeach

                    
                
            </div>


@endsection