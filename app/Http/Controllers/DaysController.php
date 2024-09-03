<?php

namespace App\Http\Controllers;

use App\Http\Resources\DaysResource;
use App\Models\DaysOfWeek;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

}
