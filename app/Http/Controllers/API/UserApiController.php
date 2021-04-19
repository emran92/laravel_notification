<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $user->device_token = request('device_token', '');
            $user->save();
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'user' => $user,
                        'device_token' => $user->device_token,
                    ],
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401
            );
        }

    }
}
