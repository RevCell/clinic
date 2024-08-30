<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class DoctorController extends Controller
{
    public function index (): JsonResponse
    {
        $index=Doctor::all();
        return response()->json([
            'message'=>'doctors index has fetched successfully',
            'detail'=>DoctorResource::collection($index),
            'status'=>200
        ]);
    }

    public function read (Doctor $doctor): JsonResponse
    {
        return response()->json([
            'message'=>'doctor profile has fetched successfully',
            'detail'=>new DoctorResource($doctor),
            'status'=>200
        ]);
    }

    public function create(DoctorRequest $request): JsonResponse
    {
        if (Gate::denies("create_doctor")){
            return \response()->json([
                'message'=>"you are not allowed to create any doctor",
                'status'=>403
            ]);
        }
        $result=Doctor::create_doctor($request->validated());
        return response()->json([
            'message'=>'new doctor created successfully',
            'detail'=>new DoctorResource($result),
            'status'=>201
        ]);
    }

    public function update(Doctor $doctor,DoctorRequest $request)
    {
        if (Gate::denies("update_doctor",$doctor)){
            return \response()->json([
                'message'=>"you are not allowed to edit any doctor",
                'status'=>403
            ]);
        }
        Doctor::update_doctor($doctor,$request);
        return response()->json([
            'message'=>'doctor updated successfully',
            'detail'=>new DoctorResource($doctor),
            'status'=>201
        ]);
    }

    public function delete(Doctor $doctor)
    {
        if (Gate::denies("delete_doctor",$doctor)){
            return \response()->json([
                'message'=>"you are not allowed to delete any doctor",
                'status'=>403
            ]);
        }
        $doctor->delete();
        return response()->json([
            'message'=>'doctor deleted successfully',
            'detail'=>new DoctorResource($doctor),
            'status'=>201
        ]);
    }
}
