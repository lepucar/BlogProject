<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    

    public function create()
    {
        return view('blogs.addBlog');
    }
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

        
        
        
        
       
        Posts::create($validatedData);
        return redirect()->route('mainPage')->with('success', 'Blog created successfully');
    }

    public function delete($id)
    {
        Posts::where('id', $id)->delete();
        return redirect()->route('mainPage')->with('success', 'Blog deleted successfully');
    }

    public function edit($id)
    {
        $blog = Posts::where('id', $id)->first();
        return view('blogs.editBlog', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required||min:3|max:255',
            'description' => 'required|min:3',
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
           
        unset($validatedData['_token']);
        $posts=Posts::find($id);
        
        $posts->update($validatedData);
        return redirect()->route('mainPage')->with('success', 'Blog updated successfully');
    }
}
