@extends('doctor.layout')
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
@elseif(Session::has('danger'))
<script>
    $( document ).ready(function() {
        $('#myModal').modal('show');
    });
</script>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body" style="display: flex; justify-content:center; align-items:center;">
           <span style="color:red !important; font-weight:bold; align-text:center; padding:0px; margin:0px;">{{ Session::get('danger') }}</span>
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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Patients Appointment List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered"  id="appointmentTable"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Schedule</th>
                                <th>Patient</th>
                                <th>Service</th>
                                <th>Room</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($doctor->appointments!=null)
                                @if($doctor->appointments->count()!=0)
                                @foreach ($doctor->appointments as $appointment)
                                <tr>
                                    <td>
                                    @if ($appointment->is_approve==0 || $appointment->is_approve==1)
                                    @php
                                    $now = \Carbon\Carbon::now('Asia/Manila');
                                    $diff = $now->diffForHumans($appointment->start_date_at);
                                    $startDate = \Carbon\Carbon::parse($appointment->start_date_at, 'Asia/Manila')->addHour();
                                    $timeDifference = $now->diffInSeconds($appointment->start_date_at, false);
                                    if ($timeDifference <= 0) {
                                        if ($timer = \Carbon\Carbon::now('Asia/Manila')->gt(\Carbon\Carbon::parse($appointment->start_date_at, 'Asia/Manila')->addHour())) {
                                                echo "<span style='color:red'>Expired</span>.";
                                            }else{
                                                echo "<span style='display:flex;flex-direction:column;'>";
                                                echo "<span>".$now->diffForHumans($startDate)." Expire</span>";
                                                echo "<small style='color:blue;'>Additional 1 hour.</small>";
                                                echo "</span>";
                                            }
                                    } else {
                                        echo "<span style='display:flex;flex-direction:column;'>";
                                        echo "<span>".date('M d ,Y , h:i:s:a',strtotime($appointment->start_date_at))."</span>";
                                        echo "<small style='color:blue;'>".$diff." Expire.</small>";
                                        echo "</span>";
                                    }
                                    @endphp
                                    @elseif($appointment->is_approve==5)
                                    <span style="color:green;">On Going</span>
                                    @endif
                                    </td>
                                    <td>{{ $appointment->patient->firstname }} {{ $appointment->patient->middlename }} {{ $appointment->patient->lastname }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->room->number.' ( '.$appointment->room->name.' ) ' }}</td>
                                    <td>
                                        @if ($appointment->is_approve===0)
                                        <span style="color:orange;">Pending</span>
                                        @elseif($appointment->is_approve===1)
                                            <span style="color:green;">Approved</span>
                                        @elseif($appointment->is_approve===2)
                                        <span style="color:red;">Declined</span>
                                        @elseif($appointment->is_approve===4)
                                            <span style="color:red;">Expired</span>
                                        @elseif($appointment->is_approve===5)
                                            <span style="color:green;">On Going</span>
                                        @else
                                            error
                                        @endif
                                    </td>
                                    <td><a class="btn btn-sm btn-info" href="{{ route("doctor.appointment.show",$appointment->id) }}">Show</a></td>
                                </tr>
                                @endforeach
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toolTipFunction(){
        alert('hello')
    }
</script>
@endsection
