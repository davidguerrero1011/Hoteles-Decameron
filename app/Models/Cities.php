<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'country_id', 'status' ];
    protected $guarded = ['id'];


    public function hotel()
    {
        return $this->hasOne(Hotels::class);
    }
}
