<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentsRooms extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function appointment(){
        return $this->belongsTo(Appointments::class);
    }

    public function appointments(){
        return $this->hasMany(Appointments::class,'room_id','room_id');
    }

    public function room(){
        return $this->belongsTo(Rooms::class);
    }
}
