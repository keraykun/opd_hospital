<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.service.index',['services'=>Services::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>['required','unique:services,name'],
            'cost'=>['required','integer'],
        ]);
        Services::create($validate);
        return redirect()->route('admin.service.index')->with('success','Successfully Service has been created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $room)
    {
        return $room;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $service)
    {
        return view('admin.service.edit',['service'=>$service]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Services $service)
    {

        $validate = $request->validate([
            'name'=>['required'],
            'cost'=>['required','integer'],
        ]);
        Services::where('id',$service->id)->update($validate);
        return redirect()->route('admin.service.edit',$service->id)->with('success','Successfully Room has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $service)
    {
       Services::destroy('id',$service->id);
       return redirect()->route('admin.service.index')->with('danger','Successfully Room has been Deleted !');
    }
}
