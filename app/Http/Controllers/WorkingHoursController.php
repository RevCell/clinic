<?php

namespace App\Http\Controllers;

use App\Http\Requests\WH_adminRequest;
use App\Http\Requests\WH_doctorRequest;
use App\Http\Resources\WorkingHoursResource;
use App\Models\Doctor;
use App\Models\WorkingHours;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class WorkingHoursController extends Controller
{

    public function index(): JsonResponse
    {
        $index=WorkingHours::all();
        return response()->json([
           'message'=>"index of working hours has successfully been fetched",
           'detail'=>WorkingHoursResource::collection($index),
           'status'=>200
        ]);
    }

    public function read(WorkingHours $workingHours): JsonResponse
    {
        return response()->json([
            'message'=>"selected working hour has successfully been fetched",
            'detail'=>new WorkingHoursResource($workingHours),
            'status'=>200
        ]);
    }


    public function create(WH_doctorRequest $request): JsonResponse
    {
        if (Gate::denies("create_working_hour")){
            return \response()->json([
                'message'=>"you are not allowed to create a working hour for a doctor",
                'status'=>401
            ]);
        }
        $user=auth()->user();
        $doctor=Doctor::query()->where("user_id",$user['id']);
        $result=WorkingHours::create_working_hour($request->validated(),$doctor);
        return response()->json([
            'message'=>"new working hour has successfully been created",
            'detail'=> new WorkingHoursResource($result),
            'status'=>201
        ]);
    }


    public function update_doctor(WorkingHours $workingHours,WH_doctorRequest $request):JsonResponse
    {
        if (Gate::denies("doctor_update_working_hour",$workingHours)){
            return \response()->json([
                'message'=>"you are not allowed to edit a working hour for a doctor",
                'status'=>401
            ]);
        }
        WorkingHours::update_working_hour_doctor($workingHours,$request);
        return response()->json([
            'message'=>"selected working hour has successfully been updated",
            'detail'=>new WorkingHoursResource($workingHours),
            'status'=>201
        ]);
    }


    public function update_admin(WH_adminRequest $request, WorkingHours $workingHours): JsonResponse
    {
        if (Gate::denies("admin_update_working_hour",$workingHours)){
            return \response()->json([
                'message'=>"you are not authorized to edit this part of a working hour",
                'status'=>401
            ]);
        }
        WorkingHours::update_working_hour_admin($workingHours,$request);
        return response()->json([
            'message'=>"selected working hour has successfully been updated",
            'detail'=>new WorkingHoursResource($workingHours),
            'status'=>201
        ]);
    }


    public function delete(WorkingHours $workingHours): JsonResponse
    {
        if (Gate::denies("delete_working_hour",$workingHours)){
            return \response()->json([
                'message'=>"you are not allowed to delete a working hour for a doctor",
                'status'=>401
            ]);
        }
        $workingHours->delete();
        return response()->json([
            'message'=>'selected working hour has successfully been deleted',
            'detail'=>new WorkingHoursResource($workingHours),
            'status'=>200
        ]);
    }
}
