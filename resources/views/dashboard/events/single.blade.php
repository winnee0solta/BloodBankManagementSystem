@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/" class="text-dark">Home</a></li>
        <li class="breadcrumb-item"><a href="/events" class="text-dark">Events</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$event->title}}</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12 col-md-3">
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h5 class="card-title">{{$event->title}}</h5>
                <p class="cart-text">
                    {{$event->desc}}
                </p>
                <p>
                    <span>
                        Date & Time : {{$event->date_time}}
                    </span>
                    <br>
                    <span>
                        Location : {{$event->location}}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9">
        {{-- Donation Record  --}}
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title ">Donation Record</h5>
                    <a href="/events/{{$event->id}}/view/add-donation-record" type="button" class="btn btn-dark active" >
                        Add Donation Record
                    </a>
                </div>

                <div class="  mt-3 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Volume (ml)</th>
                                @if (Auth::user()->type == 'admin')

                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($records))
                            @foreach ($records as $item)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['age']}}</td>
                                <td>{{ $item['gender']}}</td>
                                <td>{{ $item['address']}}</td>
                                <td>{{ $item['contact_no']}}</td>
                                <td>{{ $item['blood_group']}}</td>
                                <td>{{ $item['volume']}}</td>

                                @if (Auth::user()->type == 'admin')

                                <td>
                                    <a href="/events/{{$event->id}}/remove-donation-record/{{$item['id']}}"><i
                                            class="material-icons">delete</i></a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{-- !Ends. Donation Record  --}}
        {{-- Registered Donors --}}
    </div>
</div>
@endsection

@section('modal')
{{-- Modal   --}}
<div class="modal fade" id="addDonationRecordModal" tabindex="1" role="dialog"
    aria-labelledby="addDonationRecordModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/events/{{$event->id}}/view/add-donation-record" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        <input name="name" required type="text" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label for="age" class="bmd-label-floating">Age</label>
                        <input name="age" required type="number" class="form-control" id="age">
                    </div>

                    <div class="form-group">
                        <label for="gender" class="bmd-label-floating">Gender</label>
                        <label class="radio-inline pt-3">
                            <input type="radio" name="gender" id="inlineRadio1" value="male" checked> Male
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="address" class="bmd-label-floating">Address</label>
                        <input name="address" required type="text" class="form-control" id="address">
                    </div>

                    <div class="form-group">
                        <label for="contact_no" class="bmd-label-floating">Contact No</label>
                        <input name="contact_no" required type="text" class="form-control" id="contact_no">
                    </div>

                    <div class="form-group">
                        <label for="blood_group" class="bmd-label-floating">Blood Group</label>
                        <input name="blood_group" required type="text" class="form-control" id="blood_group">
                    </div>

                    <div class="form-group">
                        <label for="volume" class="bmd-label-floating">Volume (ml)</label>
                        <input name="volume" required type="number" class="form-control" id="volume">
                    </div>

                    <button type="submit" class="btn btn-primary btn-raised mt-4">Add Record</button>
                </form>

            </div>
        </div>
    </div>
</div>
{{--!Ends. Modal   --}}
@endsection
