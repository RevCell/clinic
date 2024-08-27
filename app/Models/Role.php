<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permission_check($permission)
    {
        $result=Permission::query()->where("title",$permission)->firstOrFail();
        return $this->permissions()->where("id",$result->id)->exists();
    }

    public static function create_role($request)
    {
        $role=Role::query()->create([
            'title'=>$request['title']
        ]);
        return $role;
    }

    public static function update_role($request,$role)
    {
        $role->update([
            'title'=>$request['title']
        ]);
        return $role;
    }
}
