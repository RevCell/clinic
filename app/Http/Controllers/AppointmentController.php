<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentDoctorRequest;
use App\Http\Requests\AppointmentPatientRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        if (Gate::denies("index_appointment")){
            return response()->json([
                'message'=>"you are now allowed to see the list of appointments",
                'status'=>401
            ]);
        }
        $user=auth()->user();
        $index=Appointment::query()->where("user_id",$user['id'])->get();
        return response()->json([
            'message'=>"doctor's appointments has successfully been fetched",
            'detail'=>AppointmentResource::collection($index),
            'status'=>200
        ]);
    }

    public function read(Appointment $appointment):JsonResponse
    {
        if (Gate::denies("read_appointment",$appointment)){
            return response()->json([
                'message'=>"you are now allowed to see this appointment",
                'status'=>401
            ]);
        }
        return response()->json([
            'message'=>'selected appointment has successfully been fetched',
            'detail'=>new AppointmentResource($appointment),
            'status'=>200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AppointmentPatientRequest $request):JsonResponse
    {
        if (Gate::denies("create_appointment")){
            return response()->json([
                'message'=>"you are now allowed to create appointments",
                'status'=>401
            ]);
        }
        $user=auth()->user();
        $result=Appointment::create_appointment($request->validated(),$user);
        return response()->json([
            'message'=>"new appointment has successfully been created",
            'detail'=>new AppointmentResource($result),
            'status'=>200
        ]);
    }



    public function update_patient(Appointment $appointment,AppointmentPatientRequest $request): JsonResponse
    {
        if (Gate::denies("update_appointment_patient",$appointment)){
            return response()->json([
                'message'=>"you are now allowed to edit any appointments",
                'status'=>401
            ]);
        }
        $user=auth()->user();
        Appointment::update_patient($appointment,$user,$request->validated());
        return response()->json([
            'message'=>"selected appointment has successfully been updated",
            'detail'=>new AppointmentResource($appointment),
            'status'=>201
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_doctor(Appointment $appointment,AppointmentDoctorRequest $request): JsonResponse
    {
        if (Gate::denies("update_appointment_doctor",$appointment)){
            return response()->json([
                'message'=>"you must be a doctor to be able to edit this appointment",
                'status'=>401
            ]);
        }
        Appointment::update_doctor($appointment,$request->validated());
        return response()->json([
            'message'=>"selected appointment has successfully been updated by a doctor",
            'detail'=>new AppointmentResource($appointment),
            'status'=>201
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_user(Appointment $appointment): JsonResponse
    {
        if (Gate::denies("delete_appointment_user",$appointment)){
            return response()->json([
                'message'=>"you are now allowed to delete any appointments",
                'status'=>401
            ]);
        }
        $user=auth()->user();
        if ($appointment->user_id == $user['id']) {
            $appointment->delete();
            return response()->json([
                'message' => "selected appointment has successfully been deleted",
                'detail' => new AppointmentResource($appointment),
                'status' => 200
            ]);
        }
        else{
            return \response()->json([
                'message'=>'you can not delete other users appointments',
                'status'=>401
            ]);
        }
    }
    public function delete_admin(Appointment $appointment): JsonResponse
    {
        if (Gate::denies("delete_appointment_admin",$appointment)){
            return response()->json([
                'message'=>"you are now allowed to delete any appointments",
                'status'=>401
            ]);
        }
        $appointment->delete();
        return response()->json([
            'message'=>"selected appointment has successfully been deleted",
            'detail'=>new AppointmentResource($appointment),
            'status'=>200
        ]);
    }
}
