<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcommodationByRoomsType extends Model
{
    use HasFactory;
    protected $fillable = [ 'room_type_id', 'acommodation_type_id', 'hotel_id', 'among', 'status' ];
    protected $guarded = ['id'];
}
