@extends('dashboard.layouts.base')

@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item "><a href="/dashboard" class="text-dark">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Donors</li>
    </ol>
</nav>



<div class="card mt-3">
    <div class="card-body">

        <h5 class="card-title">Donors Lists</h5>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Blood Group</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        @if (Auth::user()->type == 'admin')

                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($donors))
                    @foreach ($donors as $item)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>
                        @if ($item['image'] == '-')
                           <img src="{{asset('/images/profile_placeholder.png')}}" class="img-fluid " style="max-height: 45px;">
                           @else

                           <img src="{{asset('/images/profile/'.$item['image'])}}" class="img-fluid " style="max-height: 45px;">
                           @endif
                        </td>

                        <td>{{$item['name']}}</td>
                        <td>{{$item['gender']}}</td>
                        <td>{{$item['age']}}</td>
                        <td>{{$item['blood_group']}}</td>
                        <td>{{$item['address']}}</td>
                        <td>{{$item['address']}}</td>
                        <td>{{$item['contact']}}</td>
                        <td>{{$item['email']}}</td>
                        @if (Auth::user()->type == 'admin')

                        <td>
                            <a href="/donors/{{$item['user_id']}}/remove"><i class="material-icons text-danger">delete</i></a>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
