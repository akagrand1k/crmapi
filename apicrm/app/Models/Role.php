<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
    ];

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function perms()
    {
        return $this->belongsToMany(Perm::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
        // return $this->hasManyThrough(User::class, Identity::class, 'role_id','id','id', 'user_id');
    }

    public function scopeCompanyRoles($query)
    {
        return $query->join(
            'role_user',
            'role_user.user_id',
            '=',
            'users.id'
        )
        ->join(
            'roles',
            'role_user.role_id',
            '=',
            'roles.id'
        )
        ->where('roles.company_id', $this->company_id);
    }

    public function scopeDefaultRoles($query)
    {
        return $query->whereCompanyIdAndDefault(NULL, TRUE)->with('perms');
    }
}
