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
    <div class="container" id="fillUpFormReg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Account') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.account.update',auth()->user()->id) }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="email" class="col-form-label text-md-end">{{ __('Email address') }}</label>
                                    <input id="email" disabled type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="password" class="col-form-label text-md-end">{{ __('Old Password') }}</label>
                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="new-password">
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="password" class="col-form-label text-md-end">{{ __('New Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-md-12">
                                    <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
