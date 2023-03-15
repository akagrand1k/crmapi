<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    // protected $dateFormat = 'Y-m-d H:i:s';
}
