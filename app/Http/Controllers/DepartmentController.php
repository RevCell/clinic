<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    public function index(): JsonResponse
    {
        $departments=Department::all();
     return response()->json([
         'message'=>'department index has fetched successfully',
         'detail'=> DepartmentResource::collection($departments),
         'status'=>200
     ]);
    }

    public function read(Department $department): JsonResponse
    {
        return response()->json([
            'message'=>"selected department has fetched successfully",
            'detail'=> new DepartmentResource($department),
            'status'=>200
        ]);
    }

    public function create(DepartmentRequest $request): JsonResponse
    {
        if (Gate::denies("create_department")){
            return response()->json([
                'message'=>"you are now allowed to create any department",
                'status'=>401
            ]);
        }
        $result=Department::create_department($request->validated());
        return response()->json([
            'message'=>'department created successfully',
            'detail'=> new DepartmentResource($result),
            'status'=>201
        ]);
    }

    public function update(Department $department,DepartmentRequest $request): JsonResponse
    {
        if (Gate::denies("update_department",$department)){
            return response()->json([
                'message'=>"you are now allowed to update any department",
                'status'=>401
            ]);
        }
        $result=Department::update_department($department,$request->validated());
        return response()->json([
            'message'=>'department updated successfully',
            'detail'=> new DepartmentResource($department),
            'status'=>201
        ]);
    }

    public function delete(Department $department): JsonResponse
    {
        if (Gate::denies("delete_department",$department)){
            return response()->json([
                'message'=>"you are now allowed to delete any department",
                'status'=>401
            ]);
        }
        $department->delete();
        return response()->json([
            'message'=>"department deleted successfully",
            'detail'=>new DepartmentResource($department),
            'status'=>200
        ]);
    }
}
