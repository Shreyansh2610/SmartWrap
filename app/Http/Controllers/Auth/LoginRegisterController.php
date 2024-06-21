<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginRegisterController extends Controller
{
    /**
     * Log in a user.
     *
     * This endpoint allows a user to log in by providing their email and password.
     * If the credentials are correct, it returns an access token and user information.
     *
     * @group Authentication
     *
     * @bodyParam email string required The user's email address. Example: user@example.com
     * @bodyParam password string required The user's password. Example: password123
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "User is logged in successfully.",
     *   "data": {
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "user@example.com",
     *       ...
     *     }
     *   }
     * }
     * @response 401 {
     *   "status": "failed",
     *   "message": "Invalid credentials"
     * }
     * @response 403 {
     *   "status": "failed",
     *   "message": "Validation Error!",
     *   "data": {
     *     "email": [
     *       "The email field is required."
     *     ],
     *     "password": [
     *       "The password field is required."
     *     ]
     *   }
     * }
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        // Check email exist
        $user = User::where('email', $request->email)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $data['token'] = $user->createToken($request->email)->accessToken;
        $data['user'] = $user;

        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }


    /**
     * Log out the authenticated user.
     *
     * This endpoint logs out the authenticated user by revoking all their tokens.
     *
     * @group Authentication
     * @authenticated
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "User is logged out successfully"
     * }
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User is logged out successfully'
        ], 200);
    }
}
