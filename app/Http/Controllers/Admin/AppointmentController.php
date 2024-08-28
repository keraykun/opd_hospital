<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmailDeclined;
use App\Mail\EmailDeleted;
use App\Mail\EmailNotify;
use App\Models\Appointments;
use App\Models\AppointmentsRooms;
use Illuminate\Support\Facades\DB;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Rooms;
use App\Models\Services;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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

    public function email(){
        return view('admin.appointment.email');
    }

    public function index()
    {
        $appointments = Appointments::where('is_approve',0)->orderBy('start_date_at','asc')->with(['user'])->get();
        return view('admin.appointment.index',['appointments'=>$appointments]);
    }

    public function isApprove($id)
    {
        $appointments = Appointments::where('is_approve',1)->orderBy('start_date_at','asc')->with(['user'])->get();
        return view('admin.appointment.approvelist',['appointments'=>$appointments]);
    }

    public function isGoing($id)
    {
        $appointments = Appointments::where('is_approve',5)->orderBy('start_date_at','asc')->with(['user'])->get();
        return view('admin.appointment.ongoing',['appointments'=>$appointments]);
    }

    public function isDone($id)
    {
        $appointments = Appointments::where('is_approve',3)->orderBy('start_date_at','asc')->with(['user'])->get();
        return view('admin.appointment.donelist',['appointments'=>$appointments]);
    }

    public function isDecline($id)
    {
        $appointments = Appointments::where('is_approve',2)->orderBy('start_date_at','asc')->with(['user'])->get();
        return view('admin.appointment.declinelist',['appointments'=>$appointments]);
    }

    public function isExpired($id)
    {
        $appointments = Appointments::where('is_approve',4)->orderBy('start_date_at','asc')->with(['user'])->get();
        return view('admin.appointment.expiredlist',['appointments'=>$appointments]);
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $appointment)
    {
        $doctors = Doctors::all();
        $services = Services::all();
        $rooms = Rooms::all();
        $appointment = Appointments::where('id',$appointment->id)
        ->with(['patient','service','doctor','room'])->first();
        return view('admin.appointment.show',[
            'appointment'=>$appointment,
            'doctors'=>$doctors,
            'services'=>$services,
            'rooms'=>$rooms
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointment)
    {


        //return $request;
        $date = date('Y-m-d',strtotime($appointment->start_date_at));
         $request->validate([
            'service'=>['required'],
            'doctor'=>['required'],
            'room'=>['required']
        ]);
       $count = AppointmentsRooms::where('room_id',$request->room)->whereDate('scheduled_at',$date)->count();
       if($count==0){
            AppointmentsRooms::create([
                'room_id'=>$request->room,
                'scheduled_at'=>$date
            ]);
       }

          DB::transaction(function () use($request,$appointment){
            Appointments::where('id',$appointment->id)
            ->update([
                'doctor_id'=>$request->doctor,
                'room_id'=>$request->room,
                'service_id'=>$request->service,
                'is_approve'=>1
            ]);
          });

          $appointment->with(['user','patient'])->first();
          $email = $appointment->user->email;
          $contact =  $appointment->patient->contact;
          $name = $appointment->patient->firstname.' '.$appointment->patient->middlename.' '.$appointment->patient->lastname;

          Mail::to($email)->send(new EmailNotify($email,$contact,$name));

          $basic  = new \Vonage\Client\Credentials\Basic("561d4675", "ftm6JYWH0sSeE40x");
            $client = new \Vonage\Client($basic);

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("639652086326", 'BPHK_OPD', 'A text message sent using the Nexmo SMS API')
            );
            
            $message = $response->current();
            
            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
        return redirect()->back()->with('success','Patient Appointment Accepted');
    }

    public function done(Request $request, Appointments $appointment)
    {

        Appointments::where('id',$appointment->id)
        ->update([
            'is_approve'=>3
        ]);

       // $basic  = new \Vonage\Client\Credentials\Basic("6ed780eb", "7EQGEftQtyixCj9p");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("639652086326", 'KIBAWE OPD HOSPITAL', 'Hello this is from KIBAWE OPD HOSPITAL your appointment has been done thank you for visiting us!')
        // );
        // $response->current();
        return redirect()->back()->with('success','Patient Appointment Accepted');
    }

    public function decline(Request $request, Appointments $appointment)
    {

        $appointment->with(['user','patient'])->first();
        $email = $appointment->user->email;
        $contact =  $appointment->patient->contact;
        $name = $appointment->patient->firstname.' '.$appointment->patient->middlename.' '.$appointment->patient->lastname;

        Mail::to($email)->send(new EmailDeclined($email,$contact,$name));

        Appointments::where('id',$appointment->id)
        ->update([
            'is_approve'=>2
        ]);

        // $basic  = new \Vonage\Client\Credentials\Basic("6ed780eb", "7EQGEftQtyixCj9p");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("639483236898", 'KIBAWE OPD HOSPITAL', 'Hello this is from KIBAWE OPD HOSPITAL your appointment has been done thank you for visiting us!')
        // );
        // $response->current();
        return redirect()->back()->with('danger','Patient Appointment has been Declined');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointment)
    {
        $appointment->with(['user','patient'])->first();
        $email = $appointment->user->email;
        $contact =  $appointment->patient->contact;
        $name = $appointment->patient->firstname.' '.$appointment->patient->middlename.' '.$appointment->patient->lastname;

        Mail::to($email)->send(new EmailDeleted($email,$contact,$name));
         Patients::where('id',$appointment->patient->id)->delete();
         return redirect()->route('admin.appointment.index')->with('danger','Appointment has been Deleted !');
    }
}
