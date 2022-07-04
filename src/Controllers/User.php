<?php

namespace JosimarCamilo\LaravelCore\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JosimarCamilo\LaravelCore\Controllers\Controller;

class User extends Controller
{
    public function create(Request $req)
    {
        $credentials = $req->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        $user = UserModel::create($credentials);

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
