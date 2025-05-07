<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermodel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
      
    ];


    public function cratecars()
    {
        return $this->hasMany(Cratecar::class, 'user_id');
    }
}
