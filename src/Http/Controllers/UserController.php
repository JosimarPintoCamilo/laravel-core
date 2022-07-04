<?php

namespace JosimarCamilo\LaravelCore\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $req)
    {
        $credentials = $req->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);

        return response()->json($user);
    }

    public function generateToken(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $req->validate([
            'token_name' => ['required'],
        ]);
 
        if (! Auth::attempt($credentials)) {
            return response()->json(["error" => "invalid crentials"], 400);
        }
        
        $token = $req->user()->createToken($req->token_name);

        return response()->json(['token' => $token->plainTextToken]);
    }
}
