<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'nit', 'address', 'city_id', 'rooms_capacity', 'email', 'phone', 'status' ];
    public $timestamps = true;


    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
}
