<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Relations\RelIdentityPerms;

class Identity extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable     = ['user_id', 'company_id'];
    protected $hidden       = ['password'];
    protected $dateFormat   = 'Y-m-d H:i:s';
    protected $appends      = ['user', 'company']; //, 'role'];

    public static function booted()
    {
        self::creating(function ($model) {
            $model->api_token = Str::random(108);
        });
    }

    public function apps()//+
    {
        return $this->belongsToMany(App::class)->withPivot('hidden', 'hot')->select(['slug','name','config']);
    }

    public function perms(): RelIdentityPerms
    {
        return new RelIdentityPerms($this);
    }

    public function roles() //+
    {
        return $this->belongsToMany(Role::class);
    }

    public function company() //+
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function connects()
    {
        return $this->hasMany(Connect::class);
    }

    public function gangs()
    {
        return $this->belongsToMany(Gang::class);
    }

    public function getUserAttribute()
    {
        return User::where('id', $this->attributes['user_id'])->first();
    }

    public function getCompanyAttribute()
    {
        return Company::where('id', $this->attributes['company_id'])->first();
        /*
        $companyId = $this->attributes['company_id'];
        return Cache::remember(
        implode([__CLASS__, __FUNCTION__, $companyId]),
        now()->addMinutes(10),
        function () use ($companyId) {
            return Company::where('id', $companyId)->first();
        }
        );
        */
    }
/*
    public function getRoleAttribute()
    {
        return Role::where('id', $this->attributes['role_id'])->first();

        $roleId = $this->attributes['role_id'];
        return Cache::remember(
        'cache_identity_role_' . $roleId,
        now()->addMinutes(10),
        function () use ($roleId) {
            return Role::where('id', $roleId)->first();
        }
        );

    }*/


}
