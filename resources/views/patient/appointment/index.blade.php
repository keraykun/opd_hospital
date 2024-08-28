@extends('patient.layout')
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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">My Appointment List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Schedule</th>
                                <th>Concern</th>
                                <th>Message</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @if ($user->patient!=null)
                                <tr>
                                    <td>
                                        @if ($user->patient->appointment->is_approve===1)
                                            @php
                                            $now = \Carbon\Carbon::now('Asia/Manila');
                                            $diff = $now->diffForHumans($user->patient->appointment->start_date_at);
                                            $startDate = \Carbon\Carbon::parse($user->patient->appointment->start_date_at, 'Asia/Manila')->addHour();
                                            $timeDifference = $now->diffInSeconds($user->patient->appointment->start_date_at, false);
                                            if ($timeDifference <= 0) {
                                                if ($timer = \Carbon\Carbon::now('Asia/Manila')->gt(\Carbon\Carbon::parse($user->patient->appointment->start_date_at, 'Asia/Manila')->addHour())) {
                                                        echo "<span style='color:red'>Expired</span>.";
                                                    }else{
                                                        echo "<span style='display:flex;flex-direction:column;'>";
                                                        echo "<span>".$now->diffForHumans($startDate)." Expire</span>";
                                                        echo "<small style='color:blue;'>Additional 1 hour.</small>";
                                                        echo "</span>";
                                                    }
                                            } else {
                                                echo "<span style='display:flex;flex-direction:column;'>";
                                                echo "<span>".date('M d ,Y , h:i:s:a',strtotime($user->patient->appointment->start_date_at))."</span>";
                                                echo "<small style='color:blue;'>".$diff." Expire.</small>";
                                                echo "</span>";
                                            }
                                            @endphp
                                        @elseif($user->patient->appointment->is_approve===5)
                                            <span style="color:green;">On Going</span>
                                        @else
                                            <span style="color:orange;">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->patient->appointment->concern }}</td>
                                    <td>{{ $user->patient->appointment->message }}</td>
                                    <td>
                                        @if ($user->patient->appointment->doctor!=null)
                                        <span>Dr. {{ $user->patient->appointment->doctor->firstname.' '.$user->patient->appointment->doctor->middlename.' '.$user->patient->appointment->doctor->lastname }}</span>
                                        @else
                                            <span style="color:orange;">Pending Doctor</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->patient->appointment->is_approve===0)
                                        <span style="color:orange;">Pending</span>
                                        @elseif($user->patient->appointment->is_approve===1)
                                            <span style="color:green;">Approved</span>
                                        @elseif($user->patient->appointment->is_approve===2)
                                           <span style="color:red;">Declined</span>
                                        @elseif($user->patient->appointment->is_approve===4)
                                            <span style="color:red;">Expired</span>
                                        @elseif($user->patient->appointment->is_approve===5)
                                            <span style="color:green;">On Going</span>
                                        @else
                                            error
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('patient.appointment.show',$user->patient->appointment->id) }}" class="btn btn-primary btn-icon-split" style="margin-bottom:3px;">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Show</span>
                                        </a>
                                        @if ($user->patient->appointment->is_approve===0)
                                        <button type="button"  data-toggle="modal" data-target="#modalDelete-{{ $user->patient->appointment->id }}" class="btn btn-danger btn-icon-split" style="margin-bottom:3px;">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Remove</span>
                                        </button>
                                        @elseif ($user->patient->appointment->is_approve===1)
                                        <button type="button" data-toggle="modal" data-target="#modalCantDelete-{{ $user->patient->appointment->id }}" style="background:rgb(234, 117, 117) !important;"  class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Remove</span>
                                        </button>
                                        @else
                                        <button type="button" data-toggle="modal" data-target="#modalCantDelete-{{ $user->patient->appointment->id }}" style="background:rgb(234, 117, 117) !important;" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Remove</span>
                                        </button>
                                        @endif

                                        <div class="modal fade" data-backdrop="static" id="modalCantDelete-{{ $user->patient->appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <span style="color:rgb(164, 126, 53);">You can't delete this because it's already been Processed</span>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <form method="POST" action="{{ route('patient.appointment.destroy',$user->patient->appointment->id) }}">
                                            <div class="modal fade" data-backdrop="static" id="modalDelete-{{ $user->patient->appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <span style="color:red;">Are you sure, you want to remove your appointment?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
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
