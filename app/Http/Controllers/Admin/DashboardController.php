<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\User;
use App\Models\Room;
use App\Models\Bills;
use App\Models\Rooms;
use App\Models\Services;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $months = collect(Bills::all()->pluck('paid_at_date'))->map(function($map){
            return date('M',strtotime($map));
        })->sort()->unique()->values()->toArray();
        //Bills::whereMonth('paid_at_date',10)->sum('total_cost');
        $list_months = array_fill_keys($months,0);
        foreach(Bills::all() as $key => $bill){
            $date = date('M',strtotime($bill['paid_at_date']));
            if (array_key_exists($date,$list_months)){
                $list_months[$date] += (int)$bill->total_cost;
            }
        }
        //$list_months;
        $bill_keys = collect($list_months)->keys();
        $bill_values = collect($list_months)->values();

        $appointment = [
            'Pending'=>Appointments::where('is_approve',0)->count(),
            'Approve'=>Appointments::where('is_approve',1)->count(),
            'Decline'=> Appointments::where('is_approve',2)->count(),
            'Expired'=>Appointments::where('is_approve',4)->count(),
            'Done'=> Appointments::where('is_approve',3)->count(),
         ];
         $keys = collect($appointment)->keys();
         $values = collect($appointment)->values();

         $users_count = User::where('is_role','!=','admin')->count();
         $patients_count = Patients::count();
         $doctors_count = Doctors::count();
         $rooms_count = Rooms::count();
         $service_count = Services::count();

         $appointments_count = Appointments::count();
         $appointments_self_count = Appointments::where('appointed','self')->count();
         $appointments_guard_count = Appointments::where('appointed','guardian')->count();
        return view('admin.dashboard.index',[
            'keys'=>$keys,
            'values'=>$values,
            'services_count'=>$service_count,
            'rooms_count'=>$rooms_count,
            'users_count'=>$users_count,
            'patients_count'=>$patients_count,
            'doctors_count'=>$doctors_count,
            'appointments_count'=>$appointments_count,
            'appointments_self_count'=>$appointments_self_count,
            'appointments_guard_count'=>$appointments_guard_count,
            'bills'=>[$bill_keys,$bill_values],
            'pending_count'=>Appointments::where('is_approve',0)->count(),
            'approve_count'=>Appointments::where('is_approve',1)->count(),
            'decline_count'=> Appointments::where('is_approve',2)->count(),
            'expired_count'=>Appointments::where('is_approve',4)->count(),
            'done_count'=> Appointments::where('is_approve',3)->count(),
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // $maps = collect($bills)->pluck('paid_at_date')->map(function($map){
        //     return date('M',strtotime($map));
        // });

        // $months = $maps->sort()->unique()->values()->toArray();

        // $list_months = array_fill_keys($months,0);
        // foreach($maps as $key => $value){
        //     if (array_key_exists($value,$list_months)){
        //         $list_months[$value] += 1;
        //     }
        // }
        // $bill_keys = collect($list_months)->keys();
        // $bill_values = collect($list_months)->values();
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
