@extends('dashboard.layouts.base')

@section('content')

<div class="mt-3">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body text-center p-3">
                    <h5 class="card-title">
                        Events Organized
                    </h5>
                    <div class="text-center h1 font-weight-bold">
                        {{$total_events}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body text-center p-3">
                    <h5 class="card-title ">
                        Total Donations
                    </h5>
                    <div class="text-center h1 font-weight-bold">
                        {{$total_donations}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body text-center p-3">
                    <h5 class="card-title">
                        Total Blood Volume (ml)
                    </h5>
                    <div class="text-center h1 font-weight-bold">
                        {{$total_volume}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-5">

    <div class="card-body">
        <h5 class="card-title">Blood In Stock</h5>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Blood Group</th>
                    <th scope="col">Blood Volume (ml)</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($blood_quantities))
                    @foreach ($blood_quantities as $item)
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$item['group']}}</td>
                            <td>{{$item['volume']}}</td>
                        </tr>
                    @endforeach
                @endif
                {{-- <tr>
                    <th scope="row">1</th>
                    <td>A</td>
                    <td>20ml</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>O</td>
                    <td>120ml</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>AB</td>
                    <td>80ml</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
</div>


@endsection
