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
        <a href="{{ route('admin.room.index') }}" class="btn btn-info my-2">Back</a>
        <a href="" class="btn btn-danger my-2" data-backdrop="static" tabindex="-1" role="dialog" data-toggle="modal" data-target="#deleteModal-{{ $room->id }}"><i clas
            class="fa fa-trash"></i></a>
    </div>
    <form action="{{ route('admin.room.destroy',$room->id) }}" method="POST">
        <div class="modal fade" id="deleteModal-{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <p style="font-size: 1.3rem; color:red;">Are you sure you want to Delete this Room?</p>
                <input type="hidden" name="room" value="{{ $room->id }}">
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
        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Create Room List</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.room.update',$room->id) }}" method="POST">
           <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="" class="form-label">Room name</label>
                        <input type="text" value="{{ $room->name }}"  name="name" class="form-control">
                        @error('name')
                            <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="" class="form-label">Room Number</label>
                        <input type="text" value="{{ $room->number }}" name="number" class="form-control">
                        @error('number')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="" class="form-label">Room Cost</label>
                        <input type="text" value="{{ $room->cost }}" name="cost" class="form-control">
                        @error('cost')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
           </div>
        </form>
    </div>
</div>


@endsection
