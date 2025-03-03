@extends('layout')
@section('title')
Toy
@endsection
@section('content')
<div>
    <h1>Toy</h1>
</div>
<div>
    <button data-bs-target="#createModal" data-bs-toggle="modal">Create</button>
</div>
<div>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->gender}}</td>
            <td>
                        @foreach ($data->categories as $key => $category)
                            {{ $category->name }}
                            @if ($key < count($data->categories) - 1)
                                ,
                            @endif++
                        @endforeach
                    </td>
            <td>{{$data->brand->name}}</td>
            <td>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#updateModal{{ $data->id }}"><i class="material-icons" style="color:red">edit</i></button>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id}}"><i class="material-icons" style="color:red">delete</i></button>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<form method="post" action="{{url('toy/create')}}">
    @csrf @method("post")
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create Toy</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <lable>Name :</lable>
                    <input type="text" name="name">
                    <br>
                    <lable>Gender :</lable>
                    <select name="gender" class="form-select" id="gender">
                        <option value="boy">Boy</option>
                        <option value="girl">Girl</option>
                    </select>
                    <lable>Brand :</lable>
                    <select name="brand_id" class="form-select" id="brand_id" required>
                        <option>Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    //
                    <div id="categories-container">
                        <div class="row category-row">
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <div class="form-floating">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <select name="categories[]" class="form-select">
                                                    <option>Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label for="category">Category</label>
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
                <h1 class="modal-title fs-5" id="createModalLabel">Delete Toy </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('toy/delete/'.$data->id)}}">
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
                <h1 class="modal-title fs-5" id="createModalLabel">Update Toy </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('toy/update/'.$data->id)}}">
                @csrf @method("PUT")
                <div class="modal-body">
                    <lable>Name :</lable>
                    <input type="text" value="{{$data->name}}" name="name">
                    <br>
                    <lable>Gender :</lable>
                    <select name="gender" class="form-select" id="gender">
                        <option value="boy">Boy</option>
                        <option value="girl">Girl</option>
                    </select>
                    <lable>Brand :</lable>
                    <select name="brand_id" class="form-select" id="brand_id" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <div id="categories-container-{{ $data->id }}">
                                @foreach ($data->categories as $productCategory)
                                    <div class="row category-row">
                                        <div class="col-9">
                                            <div class="input-group mb-3">
                                                <div class="form-floating">
                                                    <select name="categories[]" class="form-select">
                                                        <option>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $productCategory->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="category">Category</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex align-items-center justify-content-evenly">
                                                <div class="btn btn-danger" onclick="deleteCategoryUpdate(this)"><i
                                                        class="fa-solid fa-trash"></i></div>
                                                <div class="btn btn-primary"
                                                    onclick="addCategoryUpdate('{{ $data->id }}')">+</div>
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