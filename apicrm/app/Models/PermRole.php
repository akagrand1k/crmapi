<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermRole extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function perm()
    {
        return $this->hasOne(Perm::class);
    }
}
