<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomConfigurations extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id', 'room_type_id', 'acommodation_type_id', 'amont', 'status'];
    protected $guarded = ['id'];
}
