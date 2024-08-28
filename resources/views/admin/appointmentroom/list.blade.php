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
        {{-- <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Assign Room List of  <span style="color:blue">{{ $rooms->name??abort(500) }}</span></h6> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered"  id="appointmentTable" cellspacing="0">
                <thead>
                    <tr>
                        <th>Schedule</th>
                        <th>Room Name</th>
                        <th>Patients List</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms['appointmentRooms'] as $room)
                        <tr>
                            <td>{{ date('M d , Y',strtotime($room['scheduled_at'])) }}</td>
                            <td>{{ $rooms['name'] }}</td>
                            <td>{{ $room['matching_dates_count'] }} <i class="fa fa-users ml-2"></i></td>
                            <td><a href="{{ route('admin.assignroom.user',$room['id']) }}" class="btn btn-info btn-sm">Show</a></td>
                            <td>
                                @if($room['status']==0)
                                <button type="button" class="btn btn-danger btn-sm" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#roomAssign-{{ $room['id'] }}">End Schedule</button>
                                <form method="POST" action="{{ route('admin.assignroom.end',$room['id']) }}">
                                    <div class="modal" id="roomAssign-{{ $room['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body" style="display: flex; justify-content:center; align-items:center;">
                                            <p>Are you sure you want to terminate this schedule?</p>
                                            <input type="hidden" name="id" value="{{ $room['id'] }}">
                                        </div>
                                        <div class="modal-footer">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger" type="submit">End Schedule</button>
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                </form>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a class="btn btn-info" href="{{ route('admin.assignroom.index') }}">Back</a>
        </div>
    </div>
</div>


@endsection
