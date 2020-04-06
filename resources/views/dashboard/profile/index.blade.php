@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</nav>


<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h5 class="card-title text-center">Profile</h5>
                @if ($profile->image == '-')
                <img src="{{asset('/images/profile_placeholder.png')}}" class="img-fluid d-block m-auto"  style="max-height: 150px;" >
                @else

                <img src="{{asset('/images/profile/'.$profile->image)}}" class="img-fluid d-block m-auto"  style="max-height: 150px;" >
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
                    <a href="/profile/edit" class="btn btn-danger active">Edit Profile</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
