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
<div>
    <div style="display: flex; justify-content:space-between;">
        <a href="{{ route('admin.doctor.index') }}" class="btn btn-info my-2">Back</a>
        <a href="" class="btn btn-danger my-2" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#deleteModal-{{ $doctor->id }}"><i clas
            class="fa fa-trash"></i></a>
    </div>
    <form action="{{ route('admin.doctor.destroy',$doctor->id) }}" method="POST">
        <div class="modal fade" id="deleteModal-{{ $doctor->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <p style="font-size: 1.3rem; color:red;">Are you sure you want to Delete this Dctor?</p>
                <input type="hidden" name="doctor" value="{{ $doctor->id }}">
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Edit Doctor</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('admin.doctor.update',$doctor->id) }}" method="post" role="form" class="php-email-form">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-7">
                    <label for="email" class="col-form-label text-md-end">{{ __('Email address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter valid email" value={{  $doctor->user->email  }}  readonly autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-7">
                    <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value={{  $doctor->user->password  }} placeholder="Enter password" readonly autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-7">
                    <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" value={{  $doctor->user->password  }} placeholder="Enter confirm password" readonly autocomplete="new-password">
                </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="">Firstname</label>
                <input type="text" value="{{  $doctor->firstname  }}" name="firstname" class="form-control @error('firstname') is-invalid @enderror"  id="firstname" placeholder="Doctor Firstname" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                @error('firstname') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group">
                <label for="">Middlename</label>
                <input type="text"  value="{{  $doctor->middlename  }}" name="middlename" class="form-control @error('middlename') is-invalid @enderror" id="middlename" placeholder="Doctor Middlename" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                   @error('middlename') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group">
                <label for="">Lastname</label>
                <input type="text"  value="{{  $doctor->lastname  }}" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname" placeholder="Doctor Lastname" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                   @error('lastname') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group">
                <label for="">Birthdate</label>
                <input type="date" name="birthdate" value="{{  $doctor->birthdate  }}" min="1930-01-01"  class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="Doctor Birthdate" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                 @error('birthdate') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                </div>
              <div class="col-md-4 form-group">
                <label for="">Gender</label>
                <select  class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                    @if($doctor->gender=='male')
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    @elseif($doctor->gender=='female')
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                    @else
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    @endif
                </select>
                @error('gender') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Contact</label>
                <input type="text" value="{{  $doctor->contact  }}" class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" placeholder="Contact Number" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                @error('contact') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-7 form-group">
                <label for="">Specialty</label>
                <select  class="form-control @error('gender') is-invalid @enderror" name="specialty" id="specialty">
                    @foreach ($services as $service)
                        @if ($doctor->service->id==$service->id)
                            <option selected value="{{  $service->id  }}">{{  $service->name  }}</option>
                        @else
                             <option value="{{  $service->id  }}">{{  $service->name  }}</option>
                        @endif
                    @endforeach
                </select>
                {{-- <input type="text" name="specialty" value="{{  $doctor->specialty  }}"  class="form-control @error('specialty') is-invalid @enderror" id="specialty" placeholder="Doctor Specialty"> --}}
                 @error('specialty') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                </div>
            </div>
            <div>
                <button class="btn btn-success" type="submit">Update Doctor</button>
            </div>
          </form>

    </div>
</div>


@endsection
