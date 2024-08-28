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
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ date('M d , Y h:i:s a',strtotime($patient->appointment->start_date_at ))}}</td>
                                    <td>{{ Str::limit($patient->appointment->concern , 30, '...') }}</td>
                                    <td>{{ Str::limit($patient->appointment->message , 50, '...') }}</td>
                                    <td>
                                        @if ($patient->appointment->doctor!=null)
                                        <span>Dr. {{ $patient->appointment->doctor->firstname.' '.$patient->appointment->doctor->middlename.' '.$patient->appointment->doctor->lastname }}</span>
                                        @else
                                            <span style="color:orange;">Pending Doctor</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($patient->appointment->is_approve===0)
                                        <span style="color:orange;">Pending</span>
                                        @elseif($patient->appointment->is_approve===1)
                                            <span style="color:green;">Approved</span>
                                        @elseif($patient->appointment->is_approve===2)
                                         <span style="color:red;">Declined</span>
                                        @elseif($patient->appointment->is_approve===3)
                                           <span style="color:green;">Done</span>
                                        @elseif($patient->appointment->is_approve===4)
                                            <span style="color:red;">Expired</span>
                                        @elseif($patient->appointment->is_approve===5)
                                            <span style="color:green;">On Going</span>
                                        @else
                                            error
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('patient.history.show',$patient->appointment->id) }}" class="btn btn-primary btn-icon-split" style="margin-bottom:3px;">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Show</span>
                                        </a>
                                    </td>
                                </tr>
                             @endforeach
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
