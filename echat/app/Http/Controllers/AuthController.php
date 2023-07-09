<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError(('Error validation'), $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }

        if(!Auth::attempt($request->only(['email', 'password']))) {
            return $this->sendError(('Email & Password does not match with our record.'), [], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();

        return $this->sendResponse(__('User Login Successfully'), [
            'token_type' => 'Bearer',
            'access_token' => $user->createToken(config('app.name'))->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse(__('User Logout Successfully'));
    }

    public function sendResponse(string $message, array $data = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, Response::HTTP_OK);

    }

    public function sendError(string $error, $errorMessages = null, int $code = Response::HTTP_NOT_FOUND)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
