@extends('site.layouts.base')



@section('content')


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card mt-5">

                <div class="card-body">
                    <h5 class="card-title">Blood In Stock</h5>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Blood Volume (ml)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($blood_quantities))
                            @foreach ($blood_quantities as $item)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$item['group']}}</td>
                                <td>{{$item['volume']}}</td>
                                <td>

                                    <button class="btn btn-dark active" data-toggle="modal"
                                        data-target="#{{$item['group']}}Modal">Request For
                                        Blood</button>

                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('modal')

@if (!empty($blood_quantities))
@foreach ($blood_quantities as $item)

<div class="modal fade" id="{{$item['group']}}Modal" tabindex="-1" role="dialog"
    aria-labelledby="{{$item['group']}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$item['group']}}ModalLabel">Request For Blood Group '{{$item['group']}}'
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/request-for-blood" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="blood_group" class="bmd-label-floating">Group</label>
                        <input name="blood_group" required type="text" class="form-control" id="blood_group"
                            value="{{$item['group']}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="volume" class="bmd-label-floating">Volume (ml)</label>
                        <input name="volume" required type="number" class="form-control" id="volume">
                    </div>
                    <div class="form-group">
                        <label for="reason" class="bmd-label-floating">Reason for request</label>
                        <textarea name="reason" required type="text" class="form-control" id="reason"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-raised mt-4">Send Request</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endforeach
@endif

@endsection
