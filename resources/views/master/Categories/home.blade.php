@extends('layouts.layout')
@section('content')
    <h1>Page Item</h1>
    @if($errors -> any())
        <h1>Errors :</h1>

        <ul>
            @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{url('/admin/category/docreate')}}" method="post">
        @csrf
        <div class="mb-3">
            <label  class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}" aria-describedby="emailHelp">
            @error('name')
                <div class="error"> {{$message}} </div> <br>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
    @if (Session::has('pesan'))
        @php($pesan = Session::get('pesan'))
        @if ($pesan['tipe'] == 0)
            <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
        @else
            <div class="alert alert-success">{{ $pesan['isi'] }}</div>
        @endif
    @endif
    <br><br>
    <h1>List Category</h1>
    <div class="card-body">
        <table class="table responsive" id="tableHasil">
            <thead class="thead-dark">
                <tr>
                    <th>Category Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories)
                    @foreach ($categories as $values)
                        <tr>
                            <td>{{ $values->id }}</td>
                            <td>{{ $values->name }}</td>
                            <td>
                                <a href="{{url("admin/category/details/".$values->id)}}" class="btn btn-primary">Detail</a>
                                <a href="{{url("admin/category/delete/".$values->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
