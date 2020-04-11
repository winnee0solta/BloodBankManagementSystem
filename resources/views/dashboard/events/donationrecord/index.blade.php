@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/" class="text-dark">Home</a></li>
        <li class="breadcrumb-item"><a href="/events" class="text-dark">Events</a></li>
        <li class="breadcrumb-item"><a href="/events/{{$event->id}}/view" class="text-dark">{{$event->title}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Blood Donation</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-12 col-md-6">

        <div id="accordion">
            {{-- unregistered  --}}
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-success active d-flex " data-toggle="collapse"
                            data-target="#unregistered" aria-expanded="true" aria-controls="unregistered">
                            Unregistered Donors Form
                            <i class="material-icons">arrow_drop_down</i>
                        </button>

                    </h5>
                </div>

                <div id="unregistered" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">

                        <form action="/events/{{$event->id}}/view/add-donation-record/unregistered" method="POST">
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


                            <div class="form-field pt-2">
                                <label for="blood_group" class="bmd-label-floating">Blood Group</label>
                                <select name="blood_group" class="form-control" id="blood_group">
                                    <option value="A+" checked> A+</option>
                                    <option value="A-"> A-</option>
                                    <option value="B+"> B+</option>
                                    <option value="B-"> B-</option>
                                    <option value="AB+"> AB+</option>
                                    <option value="AB-"> AB-</option>
                                    <option value="O+"> O+</option>
                                    <option value="O-"> O-</option>
                                </select>
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
            {{-- registered  --}}
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">

                        <button class="btn btn-success active d-flex  " data-toggle="collapse" data-target="#registered"
                            aria-expanded="false" aria-controls="registered">
                            Registered Donors Form
                            <i class="material-icons">arrow_drop_down</i>
                        </button>
                    </h5>
                </div>
                <div id="registered" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">

                        <form action="/events/{{$event->id}}/view/add-donation-record/registered" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email" class="bmd-label-floating">Registered User Email</label>
                                <input name="email" required type="email" class="form-control" id="email">
                            </div>

                           <div class="form-field pt-2">
                                <label for="blood_group" class="bmd-label-floating">Blood Group</label>
                                <select name="blood_group" class="form-control" id="blood_group">
                                    <option value="A+" checked> A+</option>
                                    <option value="A-"> A-</option>
                                    <option value="B+"> B+</option>
                                    <option value="B-"> B-</option>
                                    <option value="AB+"> AB+</option>
                                    <option value="AB-"> AB-</option>
                                    <option value="O+"> O+</option>
                                    <option value="O-"> O-</option>
                                </select>
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


            </div>
        </div>
    </div>
</div>
{{--!Ends. Modal   --}}
@endsection
