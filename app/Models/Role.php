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
}
