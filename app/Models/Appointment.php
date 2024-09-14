<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'working_hour_id',
        'status'
    ];

    public static function create_appointment($request,$user)
    {
        return Appointment::query()->create([
            'user_id'=>$user['id'],
            'working_hour_id'=>$request['working_hour_id']
        ]);
    }

    public static function update_patient($appointment,$user,$request)
    {
        return $appointment->update([
            'user_id'=>$user['id'],
            'working_hour_id'=> $request['working_hour_id']

        ]);
    }
    public static function update_doctor($appointment,$request)
    {
        return $appointment->update([
            'status'=> $request['status']
        ]);
    }



}
