@extends('dashboard.layouts.base')

@section('content')


<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item "><a href="/events" class="text-dark">Events</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>


<div class="row justify-content-center">
    <div class="col-12 col-md-6">
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h5 class="card-title text-center">Add New Event Form</h5>

                <form action="/events/add" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title" class="bmd-label-floating">Title</label>
                        <input name="title" required type="text" class="form-control" id="title">
                    </div>

                    <div class="form-group">
                        <label for="desc" class="bmd-label-floating">Description</label>
                        <textarea name="desc" required class="form-control" id="desc" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="location" class="bmd-label-floating">Location</label>
                        <input name="location" required type="text" class="form-control" id="location">
                    </div>

                    <div class="form-group">
                        <label for="date_time" class="bmd-label-floating">Date & Time</label>
                        <input name="date_time" required type="text" class="form-control" id="date_time">
                    </div>


                    <button type="submit" class="btn btn-primary btn-raised mt-4">Add Event</button>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection
