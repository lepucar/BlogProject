<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);

       

        $user = User::create($validate);
       

        
        return redirect()->route('loginPage')->with('success', 'User successfully registered');
        
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        
        $user = User::where('id', $id)->first();
        return view('backend.pages.user.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'password' => 'required|min:6|max:255',
            'gender' => 'required',
            'role' => 'required',

        ]);

        
       
        


        
        
        unset($validatedData['_token']);
        User::where('id', $id)->update($validatedData);
        return redirect()->route('users')->with('success', 'User updated successfully');
    }
}
