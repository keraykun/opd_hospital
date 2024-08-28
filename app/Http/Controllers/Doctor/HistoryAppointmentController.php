<?php

namespace App\Http\Controllers\Doctor;
use App\Models\Doctors;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor = Doctors::where('user_id',Auth::id())
        ->with(['appointments'])
        ->first();
        return view('doctor.history.index',['doctor'=>$doctor]);
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
        $appointment = Appointments::where('id',$history->id)
        ->with(['patient','service','doctor','room'])->first();
        return view('doctor.history.show',[
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
