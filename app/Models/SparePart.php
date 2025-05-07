<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $fillable =[
        'type',
        'item',
        'quantity',
        'price',
        'cretecar_id',
        
    ];


    // public function cratecar()
    // {
    //     return $this->belongsTo(Cratecar::class);
    // }
    // public function cratecarr()
    // {
    //     return $this->hasMany(Cratecar::class);
    // }

    public function cratecar()
    {
        return $this->belongsTo(Cratecar::class, 'car_id'); 
    }

    
}
