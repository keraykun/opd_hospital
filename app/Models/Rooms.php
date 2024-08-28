<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $guarded = [];




    public function appointmentRooms(){
        return $this->hasMany(AppointmentsRooms::class,'room_id');
    }

    public function appointmentRoom(){
        return $this->belongsTo(AppointmentsRooms::class,'id','room_id');
    }

    public function appointments(){
        return $this->hasMany(Appointments::class,'room_id');
    }
}
