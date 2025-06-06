<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'rooms', 'address', 'nit', 'city_id', 'status' ];
    protected $guarded = ['id'];


    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
}
