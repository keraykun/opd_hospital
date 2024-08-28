@extends('admin.layout')
@section('content')

@if (Session::has('success'))
    <script>
        $( document ).ready(function() {
            $('#myModal').modal('show');
        });
    </script>
     <!-- Success Modal-->

 <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-body" style="display: flex; justify-content:center; align-items:center;">
            <p style="color:green; font-weight:bold; align-text:center; padding:0px; margin:0px;">{{ Session::get('success') }}</p>
         </div>
         <div class="modal-footer" style="padding-top:0px; padding-bottom:0px;">
             <button class="btn btn-success" type="button" data-dismiss="modal">Close</button>
         </div>
     </div>
 </div>
</div>
@elseif (Session::has('danger'))
<script>
    $( document ).ready(function() {
        $('#myModal').modal('show');
    });
</script>
 <!-- danger Modal-->

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
 <div class="modal-content">
     <div class="modal-body" style="display: flex; justify-content:center; align-items:center;">
        <p style="color:red; font-weight:bold; align-text:center; padding:0px; margin:0px;">{{ Session::get('danger') }}</p>
     </div>
     <div class="modal-footer" style="padding-top:0px; padding-bottom:0px;">
         <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
     </div>
 </div>
</div>
</div>

@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Assign Room List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered"  id="appointmentTable" cellspacing="0">
                <thead>
                    <tr>
                        {{-- <th>Schedule</th> --}}
                        <th>Room Name</th>
                        <th>Room Number</th>
                        <th>Room List</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            {{-- <td>{{ date('M d , Y',strtotime($room->scheduled_at)) }}</td> --}}
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->number }}</td>
                            <td>
                                {{ $room->count_active }} <i class="fa fa-bed ml-2"></i>
                            </td>
                            <td><a href="{{ route('admin.assignroom.list',$room->id) }}" class="btn btn-info btn-sm">Show current list [ {{ $room->count_active }} ]</a></td>
                            <td><a href="{{ route('admin.assignroom.history',$room->id) }}" class="btn btn-info btn-sm">Show history list [ {{ $room->count_inactive }} ]</a></td>
                            {{-- <td>
                                @if ($room->appointmentRooms->count()!=0)
                                <a href="{{ route('admin.room.show',$room->id) }}" class="btn btn-info btn-sm">Show</a>
                                @else
                                <button type="button" class="btn btn-success btn-sm" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#roomAssign-{{ $room->id }}">Assign</button>
                                <form method="POST" action="{{ route('admin.room.store') }}">
                                    <div class="modal" id="roomAssign-{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body" style="display: flex; justify-content:center; align-items:center;">
                                            <input type="text" name="asdsa">
                                        </div>
                                        <div class="modal-footer">
                                            @csrf
                                            <button class="btn btn-success" type="submit" data-dismiss="modal">Assign</button>
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                </form>
                                @endif
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
