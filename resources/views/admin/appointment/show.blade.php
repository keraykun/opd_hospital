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
                    @elseif($appointment->is_approve===3)
                        <span style="color:green;">( Done )</span>
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
                <div class="card-body"  id="printable-content">
                    <div style="display:none;" id="idTest">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae obcaecati dolore voluptates accusantium dolores aliquam, minus architecto, incidunt voluptas quae fuga recusandae perferendis quasi exercitationem ipsam dolor voluptatum numquam officiis.
                    </div>
                    <div class="d-flex w-full flex-row">
                        <div class="w-50">
                            <div style="font-size: 1.2rem; font-weight:bold;">Patient Info</div>
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Firstname : </span><span>{{ $appointment->patient->firstname }}</span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Middlename : </span><span>{{ $appointment->patient->middlename }}</span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Surname : </span><span>{{ $appointment->patient->lastname }}</span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Contact : </span><span>{{ $appointment->patient->contact }}</span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Gender : </span><span>{{ $appointment->patient->gender }}</span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Birhdate : </span><span>{{ date('M d , Y',strtotime($appointment->patient->birthdate ))}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="w-50 border-left pl-3">
                            <div style="font-size: 1.2rem; font-weight:bold;">Concern</div>
                            <p class="p-2"> {{ $appointment->concern }}</p>
                            <div style="font-size: 1.2rem; font-weight:bold;">Message</div>
                            <p class="p-2"> {{ $appointment->message }}</p>
                        </div>
                   </div>
                   <div  class="border-top d-flex">
                        <div class="w-50">
                            <div style="font-size: 1.2rem; font-weight:bold;" class="mt-2">Assign</div>
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Room : </span>
                                    <span>
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
                                    </span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Service : </span>
                                    <span>
                                    @if ($appointment->service!=null)
                                    {{ $appointment->service->name }}
                                    @else
                                    <select onclick="serviceFunction(this)" name="service" style="border: none; outline:0;">
                                        <option selected value="0">Select Service </option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name.' ( '.$service->cost.' )'}}</option>
                                        @endforeach
                                    </select>
                                    @error('service') <p style="color:red; font-weight:bold;">{{ $message }}</p>  @enderror
                                    @endif
                                    </span>
                                </li>
                                <li class="list-group-item border-0">
                                    <span class="font-weight-bold mr-3">Doctor : </span>
                                    @if ($appointment->service!=null && $appointment->doctor!=null)
                                    Dr {{ $appointment->doctor->firstname.' '.$appointment->doctor->middlename.' '.$appointment->doctor->lastname }}
                                    @else
                                    <select  onclick="doctorFunction(this)" id="doctor" name="noborders" style="border: none !important; outline:0 !important;">
                                        <option selected value="0">Select Doctor </option>
                                    </select>
                                    @error('doctor') <p style="color:red; font-weight:bold;">{{ $message }}</p>  @enderror
                                    @endif
                                    {{-- <span>
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
                                    </span> --}}
                                </li>
                            </ul>
                        </div>
                        <div class="w-50 border-left pl-3">
                            <div style="font-size: 1.2rem; font-weight:bold;" class="mt-2">Appointment Schedule</div>
                            <div>{{ date('M d , Y , h:i:s a',strtotime($appointment->start_date_at ))}}</div>
                        </div>
                   </div>
                   <div class="">
                    {{-- <div style="font-size: 1.2rem; font-weight:bold;" class="mt-2">Fees</div>
                    <ul class="list-group">
                        <li class="list-group-item border-0">
                            <span class="font-weight-bold mr-3">Doctor Fee : </span>
                            <span>
                                @if ($appointment->doctor!=null)
                                <u>{{ ' ₱ '.number_format(500,2) }}</u>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item border-0">
                            <span class="font-weight-bold mr-3">Room Fee : </span>
                            <span>
                                @if ($appointment->room!=null)
                                <u>{{ ' ₱ '.number_format($appointment->room->cost,2) }}</u>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item border-0">
                            <span class="font-weight-bold mr-3">Service Fee : </span>
                            <span>
                                @if ($appointment->service!=null)
                                <u>{{ ' ₱ '.number_format($appointment->service->cost,2) }}</u>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item border-0">
                            <span class="font-weight-bold mr-3">Total Fee : </span>
                            <span>
                                @if ($appointment->room!=null && $appointment->service!=null && $appointment->doctor!=null)
                                @php
                                    $compute = (int)500 + $appointment->service->cost + (int)$appointment->room->cost;
                                    echo '<u> ₱ '.number_format($compute,2).'</u>';
                                @endphp
                            @endif
                            </span>
                        </li>
                    </ul> --}}
                    <div style="font-size: 1.2rem; font-weight:bold;" class="mt-2">Fees</div>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Doctor Fee</td>
                                <td>
                                    @if ($appointment->doctor != null)
                                        {{ ' ₱ '.number_format(500, 2) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Room Fee</td>
                                <td>
                                    @if ($appointment->room != null)
                                       {{ ' ₱ '.number_format($appointment->room->cost, 2) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Service Fee</td>
                                <td>
                                    @if ($appointment->service != null)
                                       {{ ' ₱ '.number_format($appointment->service->cost, 2) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Total Fee</td>
                                <td>
                                    @if ($appointment->room != null && $appointment->service != null && $appointment->doctor != null)
                                        @php
                                            $compute = (int)500 + $appointment->service->cost + (int)$appointment->room->cost;
                                            echo ' ₱ '.number_format($compute, 2).'';
                                        @endphp
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                   </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.appointment.index') }}" class="btn btn-info">Back</a>
                    @if ($appointment->is_approve==3)
                     <button class="btn btn-info" type="button" onclick="printForm()">Print </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printForm(){
        $('#printable-content').printThis({
            header: "<div style='display:flex; align-items:center; justify-content:center; margin-bottom:30px;'><img style='width:150px; height:150px;' src='" + "{{ asset('images/logo/logo.png') }}" + "' alt='Logo Image'><div style='display:flex; align-items:center; justify-content:center; flex-direction:column;'><h3> BPH Kibawe -  Out Patient Department</h3><h4>Patient receipt</h4></div></div>"
        });
    }
    function serviceFunction(e){
        var service = document.querySelector('#service')
        service.value = e.value

        var selectedValue = e.value
        var redirectToPage = "{{ route('admin.doctor.show', '') }}" + '/' + selectedValue;
        $.ajax({
        type: 'GET',
        url: redirectToPage,
        data:{serviceId:selectedValue},
        success: function(response) {
            console.log(response);

            // Assuming the response is an array of doctors
            var select = document.getElementsByName("noborders")[0];

            // Clear existing options
            select.innerHTML = '';

            // Add a new default option
            var defaultOption = document.createElement('option');
            defaultOption.value = '0';
            defaultOption.text = 'Select Doctor';
            select.appendChild(defaultOption);

            // Append new options based on the response
            for (var i = 0; i < response.length; i++) {
                var option = document.createElement('option');
                option.value = response[i].id;
                option.text = ' Dr. '+response[i].firstname+' '+response[i].middlename+' '+response[i].lastname;
                select.appendChild(option);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
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
