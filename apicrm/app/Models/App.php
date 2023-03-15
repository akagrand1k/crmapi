<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $appends = ['menu', 'hot'];
    protected $hidden = ['pivot'];
    //protected $visible = [];

    public function getMenuAttribute()
    {
        return $this->pivot ? $this->pivot->menu : '';
    }

    public function getHotAttribute()
    {
        return $this->pivot ? $this->pivot->hot: '';
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('menu','hot');
    }

    public function scopeMenu($menu)
    {
        return $this->belongsToMany(User::class)->withPivot('menu','hot');
    }

    public function perms()
    {
      return $this->hasMany(Perm::class);
    }

}
