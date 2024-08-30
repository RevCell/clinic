<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role() :BelongsTo
    {
        return $this->belongsto(Role::class);
    }

    public static function register($request): array
    {
        $user=User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => 2
        ]);
        $token=$user->createToken("register_token");
        return [$user,$token];
    }

    public static function login($request)
    {
        $user=User::query()->where('email',$request->email)->first();
        if (Hash::check($request->password,$user->password)) {
            $token = $user->createToken("login_token");
            return [$user,$token];
        }
        else{
            return false;
        }
    }

    public static function update_user($request,$user)
    {
        $user->update([
            'name'=>$request['name'],
            'role_id'=>$request['role_id']
        ]);
        return $user;
    }

}


