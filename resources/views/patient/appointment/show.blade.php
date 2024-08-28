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
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">My Appointment</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tr>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Contact</th>
                        </tr>
                        <tr>
                            <td>{{ $appointment->patient->firstname }}</td>
                            <td>{{ $appointment->patient->middlename }}</td>
                            <td>{{ $appointment->patient->lastname }}</td>
                            <td>{{ $appointment->patient->contact }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Appointed</th>
                            <th>Status</th>
                        </tr>
                        <tr>

                            <td>{{ date('M d , Y',strtotime($appointment->patient->birthdate ))}}</td>
                            <td>{{ $appointment->patient->gender }}</td>
                            <td>{{ $appointment->appointed }}</td>
                            <td>
                                @if ($appointment->is_approve===0)
                                <span style="color:orange;">Pending</span>
                                @elseif($appointment->is_approve===1)
                                    <span style="color:green;">Approved</span>
                                @elseif($appointment->is_approve===2)
                                    <span style="color:red;">Decline</span>
                                @elseif($appointment->is_approve===4)
                                    <span style="color:red;">Expired</span>
                                @elseif($appointment->is_approve===5)
                                    <span style="color:green;">On Going</span>
                                @else
                                    error
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">Concern</th>
                        </tr>
                        <tr style="height: 100px;">
                            <td colspan="4">
                                {{ $appointment->concern }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">Message</th>
                        </tr>
                        <tr style="height: 150px;">
                            <td colspan="4">
                                {{ $appointment->message }}
                            </td>
                        </tr>
                        <tr>
                            <th>Appointment Date</th>
                            <th>Doctor</th>
                            <th>Services</th>
                            <th>Room</th>
                        </tr>
                        <tr>
                            <td>{{ date('M d , Y h:i:s a',strtotime($appointment->start_date_at ))}}</td>


                            <td>
                                @if ($appointment->doctor!=null)
                                    Dr {{ $appointment->doctor->firstname.' '.$appointment->doctor->middlename.' '.$appointment->doctor->lastname }}
                                @else
                                    <span style="color:orange;">Pending Doctor</span>
                                @endif
                             </td>
                            <td>
                               @if ($appointment->service!=null)
                                   {{ $appointment->service->name }}
                                @else
                                   <span style="color:orange;">Pending Service</span>
                               @endif
                            </td>
                            <td>
                                @if ($appointment->room!=null)
                                {{ $appointment->room->number.' ( '.$appointment->room->name.' ) ' }}
                                @else
                                <span style="color:orange;">Pending Room</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                @if ($appointment->doctor!=null)
                                Doctor Fees <u>{{ ' ₱ '.number_format(500,2) }}</u>
                                @endif
                            </td>
                            <td>
                                @if ($appointment->service!=null)
                                Service Fees <u>{{ ' ₱ '.number_format($appointment->service->cost,2) }}</u>
                                @endif
                            </td>
                            <td>
                                @if ($appointment->room!=null)
                                Room Fees <u>{{ ' ₱ '.number_format($appointment->room->cost,2) }}</u>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @if ($appointment->room!=null && $appointment->service!=null && $appointment->doctor!=null)
                                    @php
                                        $compute = (int)500 + $appointment->service->cost + (int)$appointment->room->cost;
                                        echo 'Total <u>₱ '.number_format($compute,2).'</u>';
                                    @endphp
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><a href="{{ route('patient.appointment.index') }}" class="btn btn-info">Back</a></td>
                        </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function serviceFunction(e){
        var service = document.querySelector('#service')
        service.value = e.value
    }
    function doctorFunction(e){
        var doctor = document.querySelector('#doctor')
        doctor.value = e.value
    }
</script>
@endsection
