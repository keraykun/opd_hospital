<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
       return $this->belongsTo(User::class,'patient_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctors::class);
     }

    public function patient(){
        return $this->belongsTo(Patients::class);
    }

    public function service(){
        return $this->belongsTo(Services::class);
    }

     public function room(){
        return $this->belongsTo(Rooms::class,'room_id');
    }

    // public function appointmentroom(){
    //     return $this->belongsTo(AppointmentsRooms::class,'id','appointment_id');
    // }

}
