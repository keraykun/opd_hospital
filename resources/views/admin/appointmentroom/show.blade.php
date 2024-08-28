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

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Assign Room List of <span style="color:purple;">{{ $room->name??abort(500) }} {{ ' ( room '.$room->number.' ) ' }}</span></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered"  cellspacing="0">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Patients Name</th>
                                <th>Doctor</th>
                                <th>Service</th>
                                <th>Appointment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($room->appointmentRooms!=null)
                                @foreach ($room->appointmentRooms as $key => $room)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $room->appointment->patient->firstname.' '.$room->appointment->patient->middlename.' '.$room->appointment->patient->lastname }}</td>
                                        <td>Dr. {{ $room->appointment->doctor->firstname.' '.$room->appointment->doctor->middlename.' '.$room->appointment->doctor->lastname }}</td>
                                        <td>{{ $room->appointment->service->name }} </td>
                                        <td><a href="{{ route('admin.assignroom.appointment',$room->appointment->id) }}" class="btn btn-sm btn-info">Show</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.assignroom.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
</div>



@endsection
