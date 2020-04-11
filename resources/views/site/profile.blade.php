@extends('site.layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Profile</h5>
                    @if ($profile->image == '-')
                    <img src="{{asset('/images/profile_placeholder.png')}}" class="img-fluid d-block m-auto"
                        style="max-height: 150px;">
                    @else

                    <img src="{{asset('/images/profile/'.$profile->image)}}" class="img-fluid d-block m-auto"
                        style="max-height: 150px;">
                    @endif
                    <ul class="list-group">
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Name</p>
                                <p class="list-group-item-text">{{$profile->name}}</p>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Gender</p>
                                <p class="list-group-item-text">{{$profile->gender}}</p>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Age</p>
                                <p class="list-group-item-text">{{$profile->age}}</p>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Blood Group</p>
                                <p class="list-group-item-text">{{$profile->blood_group}}</p>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Email</p>
                                <p class="list-group-item-text">{{$user->email}}</p>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Contact</p>
                                <p class="list-group-item-text">{{$profile->contact}}</p>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="bmd-list-group-col">
                                <p class="list-group-item-heading">Address</p>
                                <p class="list-group-item-text">{{$profile->address}}</p>
                            </div>
                        </a>
                    </ul>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary active" data-toggle="modal"
                            data-target="#editProfileModal">
                            Edit Profile
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- joined events  --}}
    <div class="">


        <div class="card mt-3 mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title ">Joined Events</h5>
                </div>
                <div class="  mt-3 table-responsive">

                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Location</th>
                            <th scope="col">Donated Volume (ml)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($joined_events))
                        @foreach ($joined_events as $item)
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$item['title']}}</td>
                            <td>{{ Str::limit($item['desc'], 40) }}</td>
                            <td>{{$item['date_time']}}</td>
                            <td>{{ $item['location']}}</td>
                            <td>{{ $item['volume']}}</td>
                            <td>
                                <a href="/public-events/{{$item['event_id']}}"><i class="material-icons">remove_red_eye</i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                </div>
            </div>
        </div>


    </div>
    {{--!Ends. joined events  --}}
</div>
@endsection


@section('modal')
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModallLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">
                    Edit Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/public-profile/edit" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        @if ($profile->name == '-')

                        <input name="name" required type="text" class="form-control" id="name">
                        @else
                        <input name="name" required type="text" class="form-control" id="name"
                            value="{{$profile->name}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="age" class="bmd-label-floating">Age</label>
                        <input name="age" required type="number" class="form-control" id="age"
                            value="{{$profile->age}}">
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

                    <div class=" ">
                        <div>
                            <label class="bmd-label-floating">Gender</label>
                        </div>
                        <label class="radio-inline">
                            @if ($profile->gender == 'male')
                            <input type="radio" name="gender" id="inlineRadio1" value="male" checked> Male
                            @else
                            <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
                            @endif
                        </label>
                        <label class="radio-inline">
                            @if ($profile->gender == 'female')
                            <input type="radio" name="gender" id="inlineRadio1" value="female" checked> Female
                            @else
                            <input type="radio" name="gender" id="inlineRadio1" value="female"> Female
                            @endif
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="Contact" class="bmd-label-floating">Contact</label>
                        @if ($profile->contact == '-')

                        <input name="contact" required type="text" class="form-control" id="Contact">
                        @else
                        <input name="contact" required type="text" class="form-control" id="Contact"
                            value="{{$profile->contact}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Address" class="bmd-label-floating">Address</label>
                        @if ($profile->address == '-')

                        <input name="address" required type="text" class="form-control" id="Address">
                        @else
                        <input name="address" required type="text" class="form-control" id="Address"
                            value="{{$profile->address}}">
                        @endif
                    </div>
                    <div class="form-group pt-2">
                        <label for="Image" class="bmd-label-floating">Profile Image File</label>
                        <input name="image" type="file" class="form-control-file" id="Image">
                    </div>
                    <button type="submit" class="btn btn-primary btn-raised mt-4">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
