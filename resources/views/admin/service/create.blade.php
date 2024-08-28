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
    <div><a href="{{ route('admin.service.index') }}" class="btn btn-info my-2">Back</a></div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Create Service List</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.service.store') }}" method="POST">
           <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="" class="form-label">Service name</label>
                        <input type="text" value="{{ old('name') }}"  name="name" class="form-control">
                        @error('name')
                            <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="" class="form-label">Service Cost</label>
                        <input type="text" value="{{ old('cost') }}" name="cost" class="form-control">
                        @error('cost')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        @csrf
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
           </div>
        </form>
    </div>
</div>


@endsection
