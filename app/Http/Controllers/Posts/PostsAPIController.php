<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsAPIRequest;
use App\Mail\WelcomeMail;
use App\Models\Posts;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class PostsAPIController extends Controller
{
    public function store(Request $request)
    {
        
        
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
        ]);

        

        $validatedData['user_id'] = Auth::user()->id;

        

        
        
        if ($request->hasFile('image')) {
            
            $file = $request->file('image');
            
            $fileName = time().$file->getClientOriginalName();
            $file -> move(public_path('/uploads/blogs/'), $fileName);
            $validatedData['image'] = "/uploads/blogs/" . $fileName;
        }  
        
        
        if(!$validatedData)
        {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation error',
                'data' => null
            ], 422);

        }

        
        
        
        
       
        $data = Posts::create($validatedData);

        $userData['email'] = Auth::user()->email;
       
        
       
         Mail::to($userData['email'])->send(new WelcomeMail());
        // dd($mail);

        return response()->json([
            'status'=> 'success',
            'message' => 'Blog added successfully',
            'data' => $data,
        ],200);
        
    }

    public function delete($id)
    {
        $data = Posts::where('id', $id)->delete();
        return response()->json([
            'status'=> 'success',
            'message' => 'Blog deleted successfully',
            'data' => $data,
            
        ],200);
    }

    

    public function updatee(Request $request, $id)
    {
       
        $validatedData = $request->validate([
            'title' => 'min:3|max:255',
            'description' => 'min:3',
        ]);
        
        $validatedData['user_id'] = Auth::user()->id;
        
        

        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $oldFile = Posts::where('id', $id)->first();
            
            
            File::delete(public_path('uploads/blogs/'), $oldFile);
            $fileName = time() . $file->getClientOriginalName();
            $file->move(public_path('uploads/news/'), $fileName);
            $validatedData['image'] = "/uploads/news/" . $fileName;
        }  
        
        if(!$validatedData)
        {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation error',
                'data' => null
            ], 422);

        }

           
        unset($validatedData['_token']);
        $up = Posts::where('id', $id)->update($validatedData);
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $user[]= [$email, $name];

        new WelcomeMail($up, $user[]);
        return response()->json([
            'status'=> 'success',
            'message' => 'Blog updated successfully',
            'data' => $up,
        ],200);
        



        
    }

    public function apiGetAll()
    {
        $blogs = Posts::all();
        return response()->json([
            'status'=> 'success',
            'message' => 'Data retrieved successfully',
            'data' => $blogs,
        ],200);
    }

    public function apiGetById($id)
    {
        $blog = Posts::find($id);
        return response()->json([
            'status'=> 'success',
            'message' => 'Data retrieved successfully',
            'data' => $blog,
        ],200);

    }
}