<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cratecar extends Model
{
    use HasFactory;

    protected $fillable  =[
        'make',
        'model',
        'year',
        'color',
        'car_no',
        'km',
        'user_id',
        'image_paths',
        'total_price',
        'car_id',
    ];




    public function user()
    {
        return $this->belongsTo(Usermodel::class, 'user_id') ;
    }


    public function spareParts()
    {
        return $this->hasMany(SparePart::class ,'car_id');
    }


    
}
