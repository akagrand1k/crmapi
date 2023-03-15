<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Relations\RelUserPerms;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $dateFormat = 'Y-m-d H:i:s';
    // TODO: выдавать api_token только в SignIn/SignInit
    protected $fillable = ['password','company_id','firstname','middlename','lastname','phone','email','gender','birthday'];
    protected $visible = ['id','user_id','avatar','firstname','middlename','lastname','phone','email','gender','birthday'];
    //protected $hidden = ['password'];
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        // 'birthday' => 'datetime:Y/m/d',
    ];
    protected $upload_path = '/img/user';

    public static function booted()
    {
        self::creating(function ($model) {
          $model->password = Hash::make($model->password);
          $model->api_token = Str::random(108);
        });
    }

    public function apps()
    {
        return $this->belongsToMany(App::class)->withPivot('menu', 'hot');//->select(['id','slug','name','config']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function connects()
    {
        return $this->hasMany(Connect::class);
    }

    public function gangs()
    {
        return $this->belongsToMany(Gang::class);
    }

    public function perms(): RelUserPerms
    {
        return new RelUserPerms($this);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
        //$this->hasManyThrough(Role::class, 'role_user', 'user_id','id','id', 'role_id');
    }

    public function studentSubjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_student');
    }
    public function teacherSubjects() // only for teachers
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher');
    }

    public function scopeSearchByRoles($query, $roles)
    {
        return $query->join( 'role_user', 'role_user.user_id', '=', 'users.id' )
                     ->join( 'roles',     'role_user.role_id', '=', 'roles.id' )
                     ->whereIn( 'roles.slug', $roles )
                     ->where( 'roles.company_id', $this->company_id );
    }
    public function getIdAttribute()
    {
        return $this->attributes['user_id'] ?? $this->attributes['id'];
    }

    public static function isExistByPhoneAndPassword($phone, $password)
    {
        $user = static::where('phone', $phone)->first();
        return $user && Hash::check($password, $user->password);
    }

    public function isExist()
    {
        return static::isExistByPhoneAndPassword($this->phone, $this->password);
    }
}
