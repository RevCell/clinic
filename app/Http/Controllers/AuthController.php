<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated_data=$request->validated();
        User::register($validated_data);
        return response()->json([
            "message"=>"new user registered successfully",
            "detail"=>new UserResource($validated_data),
            "status"=>201
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request) :JsonResponse
    {
    $user = User::login($request);
        if ($user) {
            return \response()->json([
                "message" => "login was a success",
                "user detail" => new UserResource($user[0]),
                "token"=>$user[1]->plainTextToken,
                'status' => 200
            ]);
        }
        return response()->json([
            "message"=>"login failed",
            "status"=>401
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function logout(): JsonResponse
    {
        $user=Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>"user logged out successfully",
            'detail'=>new UserResource(\auth()->user()),
            'status'=>200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


}
