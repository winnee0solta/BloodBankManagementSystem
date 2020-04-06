@extends('dashboard.layouts.base')

@section('content')


<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item "><a href="/profile" class="text-dark">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>


<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h5 class="card-title text-center"> Edit Profile</h5>

                <form action="/profile/edit" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        @if ($profile->name == '-')

                        <input name="name" required type="text" class="form-control" id="name" >
                        @else
                        <input name="name" required type="text" class="form-control" id="name"
                            value="{{$profile->name}}">
                        @endif
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
