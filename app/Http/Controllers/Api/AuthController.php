<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'password' => 'required',
        ];

        $input     = $request->only('name', 'email', 'password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user     = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        return response()->json([
            'success' => true,
            'token' => $user->createToken('api')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $authUser = Auth::user();

            return response()->json([
                'token' => $authUser->createToken('api')->plainTextToken
            ]);
        }

        return response()->json(['error' => 'Unauthorised'], 401);
    }
}
