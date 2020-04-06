@extends('site.layouts.base')



@section('content')


{{-- events  --}}


<div class="container-fluid events-container">

    <div class=" ">

        <div class="h2 title text-center pt-3 pb-3">
            <span>Events</span>
        </div>
        <div class="row">
            @if (!empty($events))
            @foreach ($events as $item)
            <div class="col-12 col-md-4 mt-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{$item->title}}</h5>
                        <p class="card-text">
                            {{ Str::limit($item['desc'], 100) }}
                        </p>
                        <span>
                            {{$item->date_time}}
                        </span>
                        <br>
                        <span>
                            {{$item->location}}
                        </span>
                        <div class="text-center mt-2">
                            <a href="/public-events/{{$item->id}}"
                                class="btn  px-5 text-capitalize btn-more_info">More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>


</div>

{{--!ends events  --}}



@endsection
