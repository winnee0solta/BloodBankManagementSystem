@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>


@if (Auth::user()->type == 'admin')

<a href="/events/add" class="btn btn-dark active" data-toggle="modal" data-target="#addUserModal">Add User</a>
@endif



<div class="card mt-3 table-responsive">

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact</th>
                <th scope="col">Address</th>
                <th scope="col">Created At</th>
                @if (Auth::user()->type == 'admin')
                <th scope="col">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (!empty($users))
            @foreach ($users as $item)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$item['type']}}</td>
                <td>{{$item['image']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{ $item['email']}}</td>
                <td>{{ $item['contact']}}</td>
                <td>{{ $item['address']}}</td>
                <td>{{  date( "m/d/Y", strtotime($item['created_at']))  }}</td>
                <td>
                    @if (Auth::user()->type == 'admin')
                    <a href="/users/{{$item['user_id']}}/edit"><i class="material-icons text-dark">edit</i></a>
                    <a href="/users/{{$item['user_id']}}/remove"><i class="material-icons text-danger">delete</i></a>
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</div>
@endsection


@section('modal')
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{-- form  --}}
                <form action="/users/add" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        <input name="name" required type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="contact" class="bmd-label-floating">Contact</label>
                        <input name="contact" required type="text" class="form-control" id="contact">
                    </div>
                    <div class="form-group">
                        <label for="address" class="bmd-label-floating">Address</label>
                        <input name="address" required type="text" class="form-control" id="address">
                    </div>

                    <div>
                        <label class="bmd-label-floating">Type</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="admin" value="admin"> Admin
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="staff" value="staff"> Staff
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="date_time" class="bmd-label-floating">Email</label>
                        <input name="email" required type="text" class="form-control" id="date_time">
                    </div>
                    <div class="form-group">
                        <label for="Password" class="bmd-label-floating">Password</label>
                        <input name="password" required type="password" class="form-control" id="Password">
                    </div>


                    <button type="submit" class="btn btn-primary btn-raised mt-4">Add User</button>
                </form>
                {{--ends form  --}}


            </div>
        </div>
    </div>
</div>
@endsection
