<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gang()
    {
        return $this->belongsTo(Gang::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function mode()
    {
        return $this->belongsTo(Mode::class);
    }
}
