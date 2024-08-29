<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public static function create_department($request)
    {
        return Department::query()->create([
            'title'=>$request['title'],
            'description'=>$request['description']
        ]);
    }

    public static function update_department($department,$request)
    {
        return $department->update([
            'title'=>$request['title'],
            'description'=>$request['description']
        ]);
    }
}
