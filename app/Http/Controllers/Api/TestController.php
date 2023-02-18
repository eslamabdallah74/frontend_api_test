<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function createUser(CreateUserRequest $createUserRequest)
    {
        // first name - last name - email - password
        $user               = new User();
        $user->first_name   = $createUserRequest->first_name;
        $user->last_name    = $createUserRequest->last_name;
        $user->email        = $createUserRequest->email;
        $user->password     = Hash::make($createUserRequest->password);
        $user->save();
        return response()->json(['msg' => 'user has been created', 'status' => true]);
    }

    public function login(LoginRequest $loginRequest)
    {
        
    }
}
