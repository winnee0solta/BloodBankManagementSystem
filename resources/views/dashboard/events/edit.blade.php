@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item "><a href="/events" class="text-dark">Events</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>


<div class="row justify-content-center">
    <div class="col-12 col-md-6">
        <div class="card mt-3 mb-5">
            <div class="card-body">
                <h5 class="card-title text-center">Edit Event Form</h5>

            <form accept="/events/{{$event->id}}/edit" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title" class="bmd-label-floating">Title</label>
                        <input name="title" required type="text" class="form-control" id="title" value="{{$event->title}}">
                    </div>

                    <div class="form-group">
                        <label for="desc" class="bmd-label-floating">Description</label>
                        <textarea name="desc" required class="form-control" id="desc" rows="5">{{$event->desc}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="location" class="bmd-label-floating">Location</label>
                        <input name="location" required type="text" class="form-control" id="location" value="{{$event->location}}">
                    </div>

                    <div class="form-group">
                        <label for="date_time" class="bmd-label-floating">Date & Time</label>
                        <input name="date_time" required type="text" class="form-control" id="date_time" value="{{$event->date_time}}">
                    </div>


                    <button type="submit" class="btn btn-primary btn-raised mt-4">Update Event</button>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection
