<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function connects()
    {
        return $this->hasMany(Connect::class);
    }
}
