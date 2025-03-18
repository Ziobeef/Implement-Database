@extends('layout')
@section('title')
Genre
@endsection
@section('content')
<div>
    <h1>Genre</h1>
</div>
<div>
    <button data-bs-target="#createModal" data-bs-toggle="modal">Create</button>
</div>
<div>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->name}}</td>
            <td>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#updateModal{{ $data->id }}"><i class="material-icons" style="color:red">edit</i></button>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id}}"><i class="material-icons" style="color:red">delete</i></button>
            </td>
        </tr>
        @endforeach
    </table>
</div>


<form method="post" action="{{url('genre/create')}}">
    @csrf @method("post")
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create genre</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <lable>Name :</lable>
                    <input type="text" name="name">
                    <br>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i></button>
                    <button type="submit" class="btn btn-primary "><i class="fa-solid fa-check"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
@foreach($datas as $data)
<div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Delete genre </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('genre/delete/'.$data->id)}}">
                @csrf @method("GET")
                <div class="modal-body">
                    Are you sure want to delete this data?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i></button>
                    <button type="submit" class="btn btn-primary "><i class="fa-solid fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach($datas as $data)
<div class="modal fade" id="updateModal{{$data->id}}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Update genre </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('genre/update/'.$data->id)}}">
                @csrf @method("POST")
                <div class="modal-body">
                    <lable>Name :</lable>
                    <input type="text" value="{{$data->name}}" name="name">
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i></button>
                    <button type="submit" class="btn btn-primary "><i class="fa-solid fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach



@endsection


