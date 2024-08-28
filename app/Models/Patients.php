<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function appointment(){
        return $this->belongsTo(Appointments::class,'id','patient_id');
    }
}
