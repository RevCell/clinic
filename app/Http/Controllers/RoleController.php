<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        if (Gate::denies("index_role")){
            return response()->json([
                'message'=>'you are not allowed to view roles list',
                'status'=>401
            ]);
        }
        $roles=Role::all();
        return response()->json([
            'message'=>'role index has fetched successfully',
            'detail'=>RoleResource::collection($roles),
            'status'=>200
        ]);
    }

    public function read(Role $role):  JsonResponse
    {
        if (Gate::denies("read_role",$role)){
            return response()->json([
                'message'=>'you are not allowed to view this role',
                'status'=>401
            ]);
        }
        return response()->json([
            'message'=>"selected role has fetched successfully",
            'detail'=>new RoleResource($role),
            'status'=>200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleRequest $request)
    {
        if (Gate::denies("create_role")){
            return response()->json([
                'message'=>'you are not allowed to create role',
                'status'=>401
            ]);
        }
        $result=Role::create_role($request->validated());
        return response()->json([
            'message'=>'new role created successfully',
            'detail'=>new RoleResource($result),
            'status'=>201
        ]);
    }

    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        if (Gate::denies("update_role",$role)){
            return \response()->json([
                'message'=>"you are now allowed to update this role",
                'status'=>401
            ]);
        }
        $result=Role::update_role($request->validated(),$role);
        return \response()->json([
            'message'=>"role updated successfully",
            'detail'=>new RoleResource($result),
            'status'=>201
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        if (Gate::denies("delete_role",$role)){
            return \response()->json([
                'message'=>"you are now allowed to delete this role",
                'status'=>401
            ]);
        }
        $role->delete();
        return \response()->json([
            'message'=>"role deleted successfully",
            'status'=>200
        ]);
    }
}
