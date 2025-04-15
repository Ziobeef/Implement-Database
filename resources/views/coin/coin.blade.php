@extends('layout')
@section('title')
Coin
@endsection
@section('content')
<div>
    <h1>Coin</h1>
</div>
<div>
    <button data-bs-target="#createModal" data-bs-toggle="modal">Create</button>
</div>
<div>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Code</th>
            <th>Kurs</th>
            <th>Countries</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->code}}</td>
            <td>{{ $data->kurs->name }}</td>
            <td>
                @foreach ($data->countries as $key => $country)
                {{ $country->name }}
                @if ($key < count($data->countries) - 1)
                    ,
                    @endif
                    @endforeach
             
               
            </td>
            <td>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#updateModal{{ $data->id }}"><i class="material-icons" style="color:red">edit</i></button>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id}}"><i class="material-icons" style="color:red">delete</i></button>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<form method="post" action="{{url('coin/create')}}">
    @csrf @method("post")
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create Coin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <lable>Name :</lable>
                    <input type="text" name="name">
                    <br>
                    <lable>Code :</lable>
                    <input type="text" name="code">
                    <br>
                    <lable>kurs :</lable>
                    <select name="kurs_id" class="form-select" id="kurs_id" required>
                        @foreach ($kurses as $kurs)
                        <option value="{{ $kurs->id }}"  >{{ $kurs->name }}</option>
                        @endforeach
                    </select>

                    <div id="country-container">
                        <div class="row country-row">
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <div class="form-floating">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select name="countries[]" class="form-select">
                                                    <option>Select Country</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label>Country</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex align-items-center justify-content-evenly">
                                    <div class="btn btn-danger" onclick="deleteCountry(this)"><i
                                            class="fa-solid fa-trash"></i></div>
                                    <div class="btn btn-primary" onclick="addCountry()">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <h1 class="modal-title fs-5" id="createModalLabel">Delete Coin </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('coin/delete/'.$data->id)}}">
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
                <h1 class="modal-title fs-5" id="createModalLabel">Update Coin </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('coin/update/'.$data->id)}}">
                @csrf @method("POST")
                <div class="modal-body">
                    <lable>Name :</lable>
                    <input type="text" name="name" value="{{ $data->name }}">
                    <br>
                    <lable>code :</lable>
                    <input type="text" name="code" value="{{ $data->code }}">
                    <lable>kurs :</lable>
                    <select name="kurs_id" class="form-select" id="kurs_id" required>
                        @foreach ($kurses as $kurs)
                        <option value="{{ $kurs->id }}" {{ $kurs->id == $data->kurs_id ? 'selected' : '' }}>{{ $kurs->name }}</option>
                        @endforeach
                    </select>
                    
                    <br>
                    <div id="Countries-container-{{ $data->id }}">
                        @foreach ($data->countries as $country)
                        <div class="row country-row">
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <div class="form-floating">
                                        <select name="coutnry[]" class="form-select">
                                            <option>Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ $country->id == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="country">Country</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex align-items-center justify-content-evenly">
                                    <div class="btn btn-danger" onclick="deleteCountryUpdate(this)"><i
                                            class="fa-solid fa-trash"></i></div>
                                    <div class="btn btn-primary"
                                        onclick="addCountryUpdate('{{ $data->id }}')">+</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

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
<script>
    function addCountry() {
        const container = document.getElementById('country-container');
        const newRow = container.firstElementChild.cloneNode(true);
        newRow.querySelectorAll('[id]').forEach(el => el.removeAttribute('id'));
        const selectElement = newRow.querySelector('select');
        if (selectElement) {
            selectElement.selectedIndex = 0;
        }

        container.appendChild(newRow);
    }

    function deleteCountry(button) {
        const container = document.getElementById('country-container');
        if (container.children.length > 1) {
            button.closest('.country-row').remove();
        } else {
            alert('Minimal satu country harus ada.');
        }
    }

    function addCountryUpdate(id) {
        const container = document.getElementById(`Countries-container-${id}`);
        const newRow = container.firstElementChild.cloneNode(true);
        newRow.querySelector('select').value = '';
        container.appendChild(newRow);
    }

    function deleteCountryUpdate(button) {
        const row = button.closest('.country-row');
        const container = row.parentNode;
        if (container.children.length > 1) {
            row.remove();
        } else {
            alert('Minimal satu Country harus ada.');
        }
    }
</script>
@endsection