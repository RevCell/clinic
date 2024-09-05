<?php

namespace App\Http\Controllers;

use App\Http\Requests\DayWeekRequest;
use App\Http\Resources\DaysResource;
use App\Models\DaysOfWeek;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class DaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $index=DaysOfWeek::all();
        return response()->json([
            'message'=>"days of week index has fetched successfully",
            'detail'=>DaysResource::collection($index),
            'status'=>200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function read(DaysOfWeek $daysOfWeek): JsonResponse
    {
        return response()->json([
            'message'=>"requested day has fetched successfully",
            'detail'=>new DaysResource($daysOfWeek),
            'status'=>200
        ]);
    }

    public function create(DayWeekRequest $request,DaysOfWeek $daysOfWeek):JsonResponse
    {
        if (Gate::denies("create_wd",$daysOfWeek)){
            return response()->json([
                'message'=>'you are not allowed to create a working day for a doctor',
                'status'=>401
            ]);
        }
        $daysOfWeek->doctors()->attach($request->id);
        return response()->json([
            "message"=>"new working day has successfully been stored",
            'detail'=>new DaysResource($daysOfWeek),
            'status'=>201
        ]);
    }

    public function update(DayWeekRequest $request,DaysOfWeek $daysOfWeek): JsonResponse
    {
        if (Gate::denies("update_wd",$daysOfWeek)){
            return response()->json([
                'message'=>'you are not allowed to edit a working day for a doctor',
                'status'=>401
            ]);
        }
        $daysOfWeek->doctors()->sync($request->id);
        return response()->json([
            'message'=>"selected working day has successfully been updated",
            'detail'=>new DaysResource($daysOfWeek),
            'status'=>201
        ]);
    }

    public function delete(DayWeekRequest $request,DaysOfWeek $daysOfWeek): JsonResponse
    {
        if (Gate::denies("delete_wd",$daysOfWeek)){
            return response()->json([
                'message'=>'you are not allowed to delete a working day for a doctor',
                'status'=>401
            ]);
        }
        $daysOfWeek->doctors()->detach($request->id);
        return response()->json([
            'message'=>"selected working day has successfully been deleted",
            "detail"=>new DaysResource($daysOfWeek),
            'status'=>"200"
        ]);
    }

}
