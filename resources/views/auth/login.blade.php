@extends('components.master')

@section('body')

<h1>User Login</h1>

<form method="post" action="{{route('login')}}">
    @csrf

    
    <div class="mb-3">
        <label for="email" class="form-label">Email
            <span class="text-danger">{{$errors->first('email')}}</span>
        </label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="email">
        
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password
            <span class="text-danger">{{$errors->first('password')}}</span>
        </label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
        
    </div>

    <div class="mb-3">
        <a href="{{route('registerPage')}}">Register Here</a>
        
    </div>




    

    <div class="mb-3">
        <button class="btn btn-primary">Login</button>
    </div>

    

</form>


@endsection