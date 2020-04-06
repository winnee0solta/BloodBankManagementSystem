@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/" class="text-dark">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Events</li>
    </ol>
</nav>


@if (Auth::user()->type == 'admin')

<a href="/events/add" class="btn btn-dark active">Add Event</a>
@endif



<div class="card mt-3 table-responsive">

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Location</th>
                <th scope="col">Created At</th>
                <th scope="col">Total Donation</th>
                <th scope="col">Total Volume (ml)</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($datas))
            @foreach ($datas as $item)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$item['title']}}</td>
                <td>{{ Str::limit($item['desc'], 40) }}</td>
                <td>{{$item['date_time']}}</td>
                <td>{{ $item['location']}}</td>
                <td>{{  date( "m/d/Y", strtotime($item['created_at']))  }}</td>
                <td>{{ $item['total_donation']}}</td>
                <td>{{ $item['total_volume']}}</td>
                <td>
                    <a href="/events/{{$item['id']}}/view"><i class="material-icons">remove_red_eye</i></a>

                    @if (Auth::user()->type == 'admin')

                    <a href="/events/{{$item['id']}}/edit"><i class="material-icons text-dark">edit</i></a>
                    <a href="/events/{{$item['id']}}/remove"><i class="material-icons text-danger">delete</i></a>
                    @endif

                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</div>
@endsection
