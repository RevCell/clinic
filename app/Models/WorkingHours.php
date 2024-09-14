<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WorkingHours extends Model
{
    use HasFactory;

    protected $fillable=[
        'StartingTime',
        'EndingTime',
        'status',
        'doctor_id',
        'day_id'
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(DaysOfWeek::class,'day_id','id');
    }

    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'appointments','working_hour_id','user_id');
    }

    public static function create_working_hour($request,$doctor)
    {
        return WorkingHours::query()->create([
            'StartingTime'=>$request['StartingTime'],
            'EndingTime'=>$request['EndingTime'],
            'doctor_id'=>$doctor['id'],
            'day_id'=>$request['day_id']
        ]);
    }

    public static function update_working_hour_doctor($working_hours,$request)
    {
        return $working_hours->update([
           'StartingTime'=>$request['StartingTime'],
           'EndingTime'=>$request['EndingTime'],
           'day_id'=>$request['day_id']
        ]);
    }
    public static function update_working_hour_admin($working_hours,$request)
    {
        return $working_hours->update([
           'StartingTime'=>$request['StartingTime'],
           'EndingTime'=>$request['EndingTime'],
           'status'=>$request['status'],
           'doctor_id'=>$request['doctor_id'],
           'day_id'=>$request['day_id']
        ]);
    }

}
