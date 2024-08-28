@extends('admin.layout')
@section('content')

@if (Session::has('success'))
    <script>
        $( document ).ready(function() {
            $('#myModal').modal('show');
        });
    </script>
     <!-- Success Modal-->

<style>
    .noborders{
        border: 1px solid red !important;
        outline: 0 !important;
    }
</style>
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
            <div class="card-header py-3" style="display: flex; justify-content:space-between;">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Patients Appointment List
                    @if ($appointment->is_approve===0)
                    <span style="color:orange;">( Pending )</span>
                    @elseif($appointment->is_approve===1)
                        <span style="color:green;">( Approved )</span>
                    @elseif($appointment->is_approve===2)
                        <span style="color:red;">( Decline )</span>
                     @elseif($appointment->is_approve===4)
                        <span style="color:red;">( Expired )</span>
                    @elseif($appointment->is_approve===5)
                        <span style="color:green;">( On Going )</span>
                    @endif
                </h6>

               <div style="display: flex; gap:20px;">
                    @if ($appointment->is_approve==0)
                    <button type="button" class="btn btn-success" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#approveModal-{{ $appointment->id }}">Approve Appointment</button>
                    @elseif ($appointment->is_approve==5)

                    <form action="{{ route('admin.appointment.done',$appointment->id) }}" method="POST">
                    <div class="modal fade" id="doneModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                            <p style="font-size: 1.3rem;">Are you sure you want to Done this appointment?</p>
                            <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                            </div>
                            <div class="modal-footer">
                            @csrf
                            @method('PATCH')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Accept</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </form>
                    @else

                    @endif

                    <!-- Modal -->
                    <form action="{{ route('admin.appointment.update',$appointment->id) }}" method="POST">
                        <div class="modal fade" id="approveModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                <p style="font-size: 1.3rem;">Are you sure you want to Submit this?</p>
                                <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                                <input type="hidden" name="service" id="service">
                                <input type="hidden" name="doctor" id="doctor">
                                <input type="hidden" name="room" id="room">
                                </div>
                                <div class="modal-footer">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Accept</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                    @if ($appointment->is_approve==0)
                    <button type="button" class="btn btn-warning" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#declineModal-{{ $appointment->id }}">Decline</button>
                    <form action="{{ route('admin.appointment.decline',$appointment->id) }}" method="POST">
                        <div class="modal fade" id="declineModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                <p style="font-size: 1.3rem; color:goldenrod !important;">Are you sure you want to Decline this?</p>
                                <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                                </div>
                                <div class="modal-footer">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Decline</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @if ($appointment->is_approve==0)
                    <button type="button"  class="btn btn-danger" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#deleteModal-{{ $appointment->id }}"><i class="fa fa-trash"></i></button>
                    @endif
               </div>

                <form action="{{ route('admin.appointment.destroy',$appointment->id) }}" method="POST">
                  <div class="modal fade" id="deleteModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-body">
                          <p style="font-size: 1.3rem; color:red;">Are you sure you want to Delete this appointment?</p>
                          <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                          </div>
                          <div class="modal-footer">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger">Delete</button>
                          </div>
                      </div>
                      </div>
                  </div>
              </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tr>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Appointed</th>
                        </tr>
                        <tr>
                            <td>{{ $appointment->patient->firstname }}</td>
                            <td>{{ $appointment->patient->middlename }}</td>
                            <td>{{ $appointment->patient->lastname }}</td>
                            <td>{{ $appointment->appointed }}</td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{ $appointment->patient->contact }}</td>
                            <td>{{ date('M d , Y',strtotime($appointment->patient->birthdate ))}}</td>
                            <td>{{ $appointment->patient->gender }}</td>
                            <td>
                                @if ($appointment->is_approve===0)
                                    <span style="color:orange;">Pending</span>
                                @elseif($appointment->is_approve===1)
                                    <span style="color:green;">Approved</span>
                                @elseif($appointment->is_approve===2)
                                    <span style="color:red;">Decline</span>
                                @elseif($appointment->is_approve===5)
                                    <span style="color:green;">On Going</span>
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
                            <th>Service</th>
                            <th>Room</th>
                        </tr>
                        <tr>
                            <td>{{ date('M d , Y , h:i:s a',strtotime($appointment->start_date_at ))}}</td>
                            <td>
                                @if ($appointment->doctor!=null)
                                    Dr {{ $appointment->doctor->firstname.' '.$appointment->doctor->middlename.' '.$appointment->doctor->lastname }}
                                @else
                                <select onclick="doctorFunction(this)" name="noborders" style="border: none !important; outline:0 !important;">
                                    <option selected disabled>Select Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">Dr {{ $doctor->firstname.' '.$doctor->middlename.' '.$doctor->lastname }}</option>
                                    @endforeach
                                </select>
                                @error('doctor') <p style="color:red; font-weight:bold;">{{ $message }}</p>  @enderror
                                @endif
                             </td>
                            <td>
                               @if ($appointment->service!=null)
                                   {{ $appointment->service->name }}
                               @else
                               <select onclick="serviceFunction(this)" style="border: none; outline:0;">
                                <option selected disabled>Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name.' ( '.$service->cost.' )'}}</option>
                                @endforeach
                             </select>
                             @error('service') <p style="color:red; font-weight:bold;">{{ $message }}</p>  @enderror
                               @endif
                            </td>
                            <td>
                                @if ($appointment->room!=null)
                                   {{ $appointment->room->number.' ( '.$appointment->room->name.' ) ' }}
                                @else
                                <select onclick="roomFunction(this)" style="border: none; outline:0;">
                                    <option selected disabled>Select Room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->number.' ( '.$room->name.' ) ' }}</option>
                                 @endforeach
                                </select>
                                @error('room') <p style="color:red; font-weight:bold;">{{ $message }}</p>  @enderror
                                @endif
                            </td>
                            {{-- <tr>
                                <td>
                                  @if ($appointment->is_approve==0)
                                  <button type="button" class="btn btn-success" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#approveModal-{{ $appointment->id }}">Approve Appointment</button>
                                  @elseif ($appointment->is_approve==5)

                                  <form action="{{ route('admin.appointment.done',$appointment->id) }}" method="POST">
                                    <div class="modal fade" id="doneModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                            <p style="font-size: 1.3rem;">Are you sure you want to Done this appointment?</p>
                                            <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                                            </div>
                                            <div class="modal-footer">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Accept</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                  </form>
                                  @else

                                  @endif

                                    <!-- Modal -->
                                    <form action="{{ route('admin.appointment.update',$appointment->id) }}" method="POST">
                                        <div class="modal fade" id="approveModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                <p style="font-size: 1.3rem;">Are you sure you want to Submit this?</p>
                                                <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                                                <input type="hidden" name="service" id="service">
                                                <input type="hidden" name="doctor" id="doctor">
                                                <input type="hidden" name="room" id="room">
                                                </div>
                                                <div class="modal-footer">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Accept</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    @if ($appointment->is_approve==0)
                                    <button type="button" class="btn btn-warning" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#declineModal-{{ $appointment->id }}">Decline</button>
                                    <form action="{{ route('admin.appointment.decline',$appointment->id) }}" method="POST">
                                        <div class="modal fade" id="declineModal-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                <p style="font-size: 1.3rem; color:goldenrod !important;">Are you sure you want to Decline this?</p>
                                                <input type="hidden" name="appointment" value="{{ $appointment->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Decline</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </td>
                            </tr> --}}
                        </tr>
                        <tr>
                            <td colspan="5"><a href="{{ route('admin.appointment.index') }}" class="btn btn-info">Back</a></td>
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
    function roomFunction(e){
        var room = document.querySelector('#room')
        room.value = e.value
    }
</script>
@endsection
