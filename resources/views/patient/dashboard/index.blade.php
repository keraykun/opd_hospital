@extends('patient.layout')
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
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Doctors Fee</h6>
                    </div>
                    <div class="card-body" style="height: 500px; overflow-y: scroll;">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->cost }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.5rem;">Room Services</h6>
                    </div>
                    <div class="card-body" style="height: 500px; overflow-y: scroll;">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->cost }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
