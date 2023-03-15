<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration'];
    protected $visible = ['id', 'name', 'duration'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function gangs()
    {
        return $this->belongsToMany(Gang::class);
    }

    public function students()
    {
        // TODO связь через таблицу role_user
        return $this->belongsToMany(User::class, 'subject_student');
    }

    public function teachers()
    {
        // TODO связь через таблицу role_user
        return $this->belongsToMany(User::class, 'subject_teacher');
    }
}
