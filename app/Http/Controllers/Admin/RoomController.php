<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.room.index',['rooms'=>Rooms::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>['required','unique:rooms,name'],
            'number'=>['required','integer','unique:rooms,number'],
            'cost'=>['required','integer'],
        ]);
        Rooms::create($validate);
        return redirect()->route('admin.room.index')->with('success','Successfully Room has been created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rooms $room)
    {
        return $room;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rooms $room)
    {
        return view('admin.room.edit',['room'=>$room]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rooms $room)
    {

        $validate = $request->validate([
            'name'=>['required'],
            'number'=>['required','integer','unique:rooms,number,'.$room->id],
            'cost'=>['required','integer'],
        ]);
        Rooms::where('id',$room->id)->update($validate);
        return redirect()->route('admin.room.edit',$room->id)->with('success','Successfully Room has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $room)
    {
       Rooms::destroy('id',$room->id);
       return redirect()->route('admin.room.index')->with('danger','Successfully Room has been Deleted !');
    }
}
