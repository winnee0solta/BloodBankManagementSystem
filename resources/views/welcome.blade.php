<div class="my-4">
    <div class="row">
        @if (!empty($events))
        @foreach ($events as $item)
        <div class="col-6 col-md-3 mt-1">
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
                        <a href="/events/{{$item->id}}" class="btn btn-success active px-5 text-capitalize">More</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
