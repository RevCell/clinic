<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'department_id'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public static function create_doctor($request)
    {
        return Doctor::query()->create([
            'name'=>$request['name'],
            'user_id'=>$request['user_id'],
            'department_id'=>$request['department_id']
        ]);
    }

    public static function update_doctor($doctor,$request)
    {
        return $doctor->update([
            'name'=>$request['name'],
            'user_id'=>$request['user_id'],
            'department_id'=>$request['department_id']
        ]);
    }
}
