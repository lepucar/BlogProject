<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function index()
    {
        if (Auth::user()->name != 'admin'){
            
            $allBlogs = Posts::all();
            foreach($allBlogs as $blog)
            {
                $username = User::find($blog->user_id);
                $blog->user_name = $username->name;
            }
            // join('users', 'users.id', '=', 'posts.user_id')->select('users.*','posts.*')->get()->toArray();
            return view('blogs.blogs', compact('allBlogs'));
        }
    }

    public function getById($id)
    {
        if(Auth::user()->name != 'admin')
        {
            $singleBlog = Posts::select('users.*','posts.*')->where('posts.id', $id)->join('users', 'users.id', '=', 'posts.user_id')->first();
            return view('blogs.blog-details', compact('singleBlog'));
        }
    }

    public function indexForAll()
    {
        
            $allBlogs = Posts::all();
            foreach($allBlogs as $blog)
            {
                $username = User::find($blog->user_id);
                $blog->user_name = $username->name;
            }
            
            return view('blogs.blogs', compact('allBlogs'));
        
    }

    
}