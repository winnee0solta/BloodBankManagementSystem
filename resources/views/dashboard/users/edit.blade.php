@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item "><a href="/users" class="text-dark">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>


<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <div class="card mt-3">

            <div class="card-body">

                <h5 class="card-title">
                    Edit User Info
                </h5>

                {{-- form  --}}
                <form action="/users/{{$user->id}}/edit" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        <input name="name" required type="text" class="form-control" id="name"
                            value="{{$admininfo->name}}">
                    </div>
                    <div class="form-group">
                        <label for="contact" class="bmd-label-floating">Contact</label>
                        <input name="contact" required type="text" class="form-control" id="contact"
                            value="{{$admininfo->contact}}">
                    </div>
                    <div class="form-group">
                        <label for="address" class="bmd-label-floating">Address</label>
                        <input name="address" required type="text" class="form-control" id="address"
                            value="{{$admininfo->address}}">
                    </div>

                    <div>
                        <label class="bmd-label-floating">Type</label>
                        <div>
                            @if ($user->type == 'admin')

                            <label class="radio-inline">
                                <input required type="radio" name="type" id="admin" value="admin" checked> Admin
                            </label>

                            @else
                            <label class="radio-inline">
                                <input required type="radio" name="type" id="admin" value="admin"> Admin
                            </label>
                            @endif

                            @if ($user->type == 'staff')
                            <label class="radio-inline">
                                <input required type="radio" name="type" id="staff" value="staff" checked> Staff
                            </label>

                            @else
                            <label class="radio-inline">
                                <input required type="radio" name="type" id="staff" value="staff"> Staff
                            </label>
                            @endif


                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Password" class="bmd-label-floating">Password</label>
                        <input name="password" type="password" class="form-control" id="Password">
                    </div>


                    <button type="submit" class="btn btn-primary btn-raised mt-4">Update</button>
                </form>
                {{--ends form  --}}

            </div>

        </div>
    </div>
</div>
@endsection
