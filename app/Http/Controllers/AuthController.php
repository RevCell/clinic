<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated_data=$request->validated();
        $result=User::register($validated_data);
        return response()->json([
            "message"=>"new user registered successfully",
            "detail"=>new UserResource($result[0]),
            'token'=>$result[1]->plainTextToken,
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
    public function index(): JsonResponse
    {
        if (Gate::denies("index_user")){
            return response()->json([
                'message'=>"you are now allowed to see users list",
                "status"=>401
            ]);
        }
        $user_list=User::all();
        return \response()->json([
           "message"=>"user list fetched successfully",
           'list'=>UserResource::collection($user_list),
           'status'=>200
        ]);
    }

    public function view(User $user): JsonResponse
    {
        if (Gate::denies("read_user",$user)){
            return response()->json([
                'message'=>'you are not allowed to view this user',
                'status'=>401
            ]);
        }
        return response()->json([
            'message'=>'selected user has fetched successfully',
            'detail'=>new UserResource($user),
            'status'=>200
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        if (Gate::denies("update_user",$user)){
            return response()->json([
                'message'=>'you are not allowed to update any users',
                'status'=>401
            ]);
        }
        $result=User::update_user($request->validated(),$user);
        return response()->json([
            'message'=>"user updated successfully",
            'detail'=>new UserResource($result),
            'status'=>200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Gate::denies("delete_user",$user)){
            return response()->json([
               'message'=>"you are not allowed to delete any users",
               'status'=>401
            ]);
        }
        $user->delete();
        return response()->json([
            'message'=>"user deleted successfully",
            'detail'=>new UserResource($user),
            'status'=>200
        ]);
    }


}
