@extends('site.layouts.base')

@section('content')


<div class="container-fluid">


  <div class="row justify-content-center">
    <div class="col-12 col-md-8">
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
</div>


{{-- record  --}}
<div class="card mt-3 mb-5">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title ">Donation Record</h5>
        </div>

        <div class="  mt-3 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Blood Group</th>
                        <th scope="col">Volume (ml)</th>
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
                        <td>{{ $item['blood_group']}}</td>
                        <td>{{ $item['volume']}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
{{--!ends. record  --}}

</div>


@endsection
