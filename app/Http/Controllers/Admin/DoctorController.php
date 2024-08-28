<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Str;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctor.index',['doctors'=>Doctors::all()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Services::all();
        return view('admin.doctor.create',['services'=>$services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;


       $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'firstname'=>['required','min:3','string'],
            'middlename'=>['required','min:3','string'],
            'lastname'=>['required','min:3','string'],
            'birthdate'=>['required'],
            'gender'=>['required','string'],
            'contact'=>['required'],
            'specialty'=>['required'],
       ]);

       DB::transaction(function () use($request){
        $user = User::create([
                'email' => $request->email,
                'is_role'=>'doctor',
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
            Doctors::create([
                'user_id'=>$user->id,
                'firstname'=>$request->firstname,
                'middlename'=>$request->middlename,
                'lastname'=>$request->lastname,
                'contact'=>$request->contact,
                'birthdate'=>$request->birthdate,
                'gender'=>$request->gender,
                'service_id'=>$request->specialty
            ]);
       });

       return redirect()->route('admin.doctor.index')->with('success','Successfully doctor has been created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$doctor)
    {
        return Doctors::where('service_id',$request->serviceId)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctors $doctor)
    {
        $services = Services::all();
        $doctor = Doctors::where('id',$doctor->id)->with(['user','service'])->first();
        return view('admin.doctor.edit',['doctor'=>$doctor,'services'=>$services]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctors $doctor)
    {



       $request->validate([
            'firstname'=>['required','min:3','string'],
            'middlename'=>['required','min:3','string'],
            'lastname'=>['required','min:3','string'],
            'birthdate'=>['required'],
            'gender'=>['required','string'],
            'contact'=>['required','integer'],
            'specialty'=>['required'],
        ]);

        Doctors::where('id',$doctor->id)->update([
            'firstname'=>$request->firstname,
            'middlename'=>$request->middlename,
            'lastname'=>$request->lastname,
            'contact'=>$request->contact,
            'birthdate'=>$request->birthdate,
            'gender'=>$request->gender,
            'service_id'=>$request->specialty
        ]);

        return redirect()->route('admin.doctor.edit',$doctor->id)->with('success','Successfully doctor has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctors $doctor)
    {
        User::where('id',$doctor->user_id)->delete();
        return redirect()->route('admin.doctor.index')->with('danger','Successfully Doctor has been Deleted !');
    }
}
