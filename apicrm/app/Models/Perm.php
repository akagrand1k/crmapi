<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perm extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
