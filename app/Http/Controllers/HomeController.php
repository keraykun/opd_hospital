<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->index();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $patient = '';
        $doctors = Doctors::all();
        if(Auth::check()){
            $patient = Patients::where('user_id',Auth::id())
           ->with('appointment')
           ->whereHas('appointment',function($query){
                return $query->where('is_approve',0)->orWhere('is_approve',1)->orWhere('is_approve',5);
           })->first();

        }
        return view('guest.index',['doctors'=>$doctors,'patient'=>$patient]);
    }

    public function doctor(){
        return view('guest.doctor');
    }

    public function admin(){
        return view('guest.admin');
    }
}
