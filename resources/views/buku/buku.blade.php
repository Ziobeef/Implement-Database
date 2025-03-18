@extends('layout')
@section('title')
Buku
@endsection
@section('content')
<div>
    <h1>Buku</h1>
</div>
<div>
    <button data-bs-target="#createModal" data-bs-toggle="modal">Create</button>
</div>
<div>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penerbit</th>
            <th>Genre</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->judul}}</td>
            <td>{{ $data->penerbit  ->name }}</td>
            <td>
                @foreach ($data->genres as $key => $genre)
                {{ $genre->name }}
                @if ($key < count($data->genres) - 1)
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

<form method="post" action="{{url('buku/create')}}">
    @csrf @method("post")
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <lable>Judul :</lable>
                    <input type="text" name="judul">
                    <br>
                    <lable>Penerbit :</lable>
                    <select name="penerbit_id" class="form-select" id="penerbit_id" required>
                        @foreach ($penerbits as $penerbit)
                        <option value="{{ $penerbit->id }}">{{ $penerbit->name }}</option>
                        @endforeach
                    </select>
                    <br>

                    <div id="categories-container">
                        <div class="row category-row">
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <div class="form-floating">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select name="genres[]" class="form-select">
                                                    <option>Select Genre</option>
                                                    @foreach ($genres as $genre)
                                                    <option value="{{ $genre->id }}">{{ $genre->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label>Genre</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex align-items-center justify-content-evenly">
                                    <div class="btn btn-danger" onclick="deleteCategory(this)"><i
                                            class="fa-solid fa-trash"></i></div>
                                    <div class="btn btn-primary" onclick="addCategory()">+</div>
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
                <h1 class="modal-title fs-5" id="createModalLabel">Delete Buku </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('buku/delete/'.$data->id)}}">
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
                <h1 class="modal-title fs-5" id="createModalLabel">Update Buku </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('buku/update/'.$data->id)}}">
                @csrf @method("POST")
                <div class="modal-body">
                    <lable>Judul :</lable>
                    <input type="text" name="name">
                    <br>
                    <lable>Penerbit :</lable>
                    <select name="penerbit_id" class="form-select" id="penerbit_id" required>
                        @foreach ($penerbits as $penerbit)
                        <option value="{{ $penerbit->id }}" {{ $penerbit->id == $data->penerbit_id ? 'selected' : '' }}>{{ $penerbit->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <lable>Genre :</lable>
                    <input type="text" name="name">
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
<script>
    function addCategory() {
        const container = document.getElementById('categories-container');
        const newRow = container.firstElementChild.cloneNode(true);
        newRow.querySelectorAll('[id]').forEach(el => el.removeAttribute('id'));
        const selectElement = newRow.querySelector('select');
        if (selectElement) {
            selectElement.selectedIndex = 0;
        }

        container.appendChild(newRow);
    }

    function deleteCategory(button) {
        const container = document.getElementById('categories-container');
        if (container.children.length > 1) {
            button.closest('.category-row').remove();
        } else {
            alert('Minimal satu kategori harus ada.');
        }
    }

    function addCategoryUpdate(id) {
        const container = document.getElementById(`categories-container-${id}`);
        const newRow = container.firstElementChild.cloneNode(true);
        newRow.querySelector('select').value = '';
        container.appendChild(newRow);
    }

    function deleteCategoryUpdate(button) {
        const row = button.closest('.category-row');
        const container = row.parentNode;
        if (container.children.length > 1) {
            row.remove();
        } else {
            alert('Minimal satu kategori harus ada.');
        }
    }
</script>
@endsection