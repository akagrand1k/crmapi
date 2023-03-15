<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gang extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
