<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GetAllUsersRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')
            ->only([
                'index',
            ]);
    }

    public function index()
    {
        return User::all();
    }

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

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }


}
