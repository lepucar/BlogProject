@extends('components.master')

@section('body')

<h1>User Register</h1>

<form method="post" action="{{route('register')}}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name
        <span class="text-danger">{{$errors->first('name')}}</span>
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{old('name')}}">
        
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email
            <span class="text-danger">{{$errors->first('email')}}</span>
        </label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{old('email')}}">
        
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password
            <span class="text-danger">{{$errors->first('password')}}</span>
        </label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
        
    </div>



    

    <div class="mb-3">
        <button class="btn btn-primary">Register</button>
    </div>

    

</form>


@endsection