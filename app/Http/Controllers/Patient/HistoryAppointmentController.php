<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $patients = Patients::where('user_id',Auth::id())->with(['appointment'])->get();
       return view('patient.history.index',['patients'=>$patients]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $history)
    {
         $appointment = Appointments::where('id',$history->id)->with(['patient','service','doctor','room'])->first();
        return view('patient.history.show',[
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
    public function destroy(string $id)
    {
        //
    }
}
