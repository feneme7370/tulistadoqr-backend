<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\confirm;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'mastercode' => ['required', 'in:Mate1882!tulistadoqr'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_id' => ['required'],
            'password' => ['required', 'confirmed'],

            // 'name' => 'required|max:255',
            // 'email' => 'required|email|unique:users',
            // 'password' => 'required|confirmed'
        ]);

        // $user = User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'company_id' => $input['company_id'],
        //     'password' => Hash::make($input['password']),
        // ]);

        $user = User::create($fields);
        $user->assignRole(['employee']);


        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'errors' => [
                    'email' => ['The provided credentials are incorrect.']
                ]
            ];
            // return [
            //     'message' => 'The provided credentials are incorrect.' 
            // ];
        }

        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.' 
        ];
    }
}
