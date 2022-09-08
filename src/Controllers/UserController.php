<?php

namespace JosimarCamilo\LaravelCore\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JosimarCamilo\LaravelCore\Requests\TokenRequest;
use JosimarCamilo\LaravelCore\Requests\UserRequest;

class UserController extends Controller
{
    public function store(UserRequest $req)
    {
        $credentials = $req->only([
            'name',
            'email',
            'password',
        ]);

        $credentials['password'] = Hash::make($req->password);

        $user = User::create($credentials);

        return response()->json($user);
    }

    public function storeToken(TokenRequest $req)
    { 
        if (! Auth::attempt(['email'=> $req->email, 'password'=>$req->password])) {
            return response()->json(["error" => "invalid crentials"], 400);
        }
        
        $token = $req->user()->createToken($req->token_name);

        return response()->json(['token' => $token->plainTextToken]);
    }
}
