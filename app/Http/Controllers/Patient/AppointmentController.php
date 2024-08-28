<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\AppointmentsRooms;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Validator;
class AppointmentController extends Controller
{

    public function __construct()
    {

        $appointments = Appointments::where('is_approve',0)->orWhere('is_approve',1)->get();

        foreach ($appointments as $appointment) {
            if (Carbon::now('Asia/Manila')->gt(Carbon::parse($appointment->start_date_at, 'Asia/Manila')->addHour())) {
                    Appointments::where('id',$appointment->id)
                    ->where(function($approve){
                        $approve->where('is_approve',0)
                        ->orWhere('is_approve',1);
                    })
                    ->update([
                        'is_approve'=>4
                    ]);
                   // AppointmentsRooms::where('appointment_id',$appointment->id)->delete();
                }
            }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = User::where('id',Auth::id())
        ->with(['patient'=>function($query){
            $query->whereHas('appointment',function($q){
                $q->where('is_approve',0)
                ->orWhere('is_approve',5)
                ->orWhere('is_approve',1);
            })
            ->with('appointment')
            ;
        }])
        ->first();
        return view('patient.appointment.index',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'firstname'=>['required','min:3','string'],
            'middlename'=>['required','min:3','string'],
            'lastname'=>['required','min:3','string'],
            'birthdate'=>['required'],
            'gender'=>['required','string'],
            'date'=>['required'],
            'contact'=>['required'],
            'message'=>['required','min:10','string'],
            'concern'=>['required','min:5','string'],
            'appointed'=>['required']
        ],[
            'birthdate.min'=>'The birthdate field must be at greater than 1930.'
        ]);

         $request_date = date('Y-m-d', strtotime($request->date));
         $dateToCheck = Carbon::parse($request_date);
         $recordCount = Appointments::whereDate('start_date_at',$dateToCheck)->count();
        if ($recordCount >= 50) {
            return redirect('/#appointment')
            ->withErrors(["counted_error" => "The appointed you choosed it's already maximum limit of 50. Please select another date"])
            ->withInput();
        }

        if ($validator->fails()) {
            return redirect('/#appointment')
                    ->withErrors($validator)
                    ->withInput();
        }
        DB::transaction(function () use($request){
            $patient = Patients::create([
                'user_id'=>Auth::id(),
                'firstname'=>$request->firstname,
                'middlename'=>$request->middlename,
                'lastname'=>$request->lastname,
                'contact'=>$request->contact,
                'birthdate'=>$request->birthdate,
                'gender'=>$request->gender,
            ]);
            Appointments::create([
                'patient_id'=>$patient->id,
                'message'=>$request->message,
                'concern'=>$request->concern,
                'appointed'=>$request->appointed,
                'is_approve'=>0,
                'start_date_at'=>$request->date
            ]);
        });

        return redirect()->route('patient.appointment.index')->with('success','New Appointment has been created !');



    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $appointment)
    {
        $appointment = Appointments::where('id',$appointment->id)->with(['patient','service','doctor','room'])->first();
        return view('patient.appointment.show',[
            'appointment'=>$appointment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointment)
    {

        Patients::where('id',$appointment->patient_id)->delete();
        return redirect()->back()->with('danger','Appointment has been Deleted !');
    }
}
