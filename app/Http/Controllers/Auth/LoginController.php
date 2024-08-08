<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function home()
    {
        
        return redirect()->route('loginPage');
    }
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)  
    {
        dd($request);
        $validations = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        dd($validations);

        if(auth()->attempt($validations))
        {
            return redirect()->route('mainPage');
        }
        else
        {
            return redirect()->back()->with('error', 'Invalid email or password');
        }



    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function apiLogin(Request $request)  
    {
        $validations = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$validations)
        {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation error',
                'data' => null
            ], 422);

        }
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) 
        {
            return response()->json([
                'status' => 'false',
                'message' => 'Email and password do not match',
                'data' => null
            ], 422);
        }

        $data['token']= $user->createToken('myApp')->plainTextToken;
        $data['name'] = $user->name;




            return response()->json([
                'status'=> 'success',
                'message' => 'Logged in successfully',
                'data' => $data,
            ],200);

            
    }
        
        



    

    public function apiLogout()
    {
        Auth::guard('sanctum')->user()->tokens()->delete();
        return response()->json([
            'status'=> 'success',
            'message' => 'Logged out successfully',
            'data' => null,
        ],200);
        
    }

    public function apiRegister(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);

        if(!$validate)
        {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation error',
                'data' => null
            ], 422);

        }

        $user = User::create($validate);
        $data['token']= $user->createToken('myApp')->plainTextToken;
        $data['name'] = $user->name;

        return response()->json([
            'status'=> 'success',
            'message' => 'Registered successfully',
            'data' => $data,
        ],200);
        

        
        
        
    }

    

}
