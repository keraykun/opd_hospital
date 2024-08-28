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
    <div><a href="{{ route('admin.doctor.index') }}" class="btn btn-info my-2">Back</a></div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Create Doctor</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('admin.doctor.store') }}" method="post" role="form" class="php-email-form">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <label for="email" class="col-form-label text-md-end">{{ __('Email address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter valid email" name="email" value="{{ old('email') }}" autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-7">
                    <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" name="password" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-7">
                    <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm password" autocomplete="new-password">
                </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="">Firstname</label>
                <input type="text" value="{{ old('firstname') }}" name="firstname" class="form-control @error('firstname') is-invalid @enderror"  id="firstname" placeholder="Doctor Firstname" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                @error('firstname') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group">
                <label for="">Middlename</label>
                <input type="text" value="{{ old('middlename') }}" name="middlename" class="form-control @error('middlename') is-invalid @enderror" id="middlename" placeholder="Doctor Middlename" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                   @error('middlename') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group">
                <label for="">Lastname</label>
                <input type="text" value="{{ old('lastname') }}" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname" placeholder="Doctor Lastname" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                   @error('lastname') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group">
                <label for="">Birthdate</label>
                <input type="date" name="birthdate" value="{{ old('birthdate') }}" min="1930-01-01"  class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="Doctor Birthdate" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                 @error('birthdate') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                </div>
              <div class="col-md-4 form-group">
                <label for="">Gender</label>
                <select  class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                    <option selected disabled>Choose</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Contact</label>
                <input type="text" value="{{ old('contact') }}" class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" placeholder="Contact Number" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                @error('contact') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
              </div>
              <div class="col-md-7 form-group">
                <label for="">Specialty</label>
                <select  class="form-control @error('gender') is-invalid @enderror" name="specialty" id="specialty">
                    @foreach ($services as $service)
                    <option value="{{  $service->id  }}">{{  $service->name  }}</option>
                    @endforeach
                </select>
                 @error('specialty') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
             </div>
            </div>
            <div>
                <button class="btn btn-success" type="submit">Create Doctor</button>
            </div>
          </form>

    </div>
</div>


@endsection
