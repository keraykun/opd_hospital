@extends('doctor.layout')
@section('content')

<div class="row">
    <div class="col-md-12">
       <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="card-body">
                    <div>
                        <img class="img-thumbnail" src="{{ asset('images/dashboard/asdd.png') }}" alt="">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="card-body">
                    <img class="img-thumbnail" src="{{ asset('images/dashboard/aaxxx.jpg') }}" alt="">
                </div>
            </div>
        </div>
       </div>
    </div>
</div>

@endsection
