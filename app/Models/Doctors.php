<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Services::class,'service_id','id');
    }

    public function appointments(){
        return $this->hasMany(Appointments::class,'doctor_id');
    }
}
