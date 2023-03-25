@extends('layouts.layout')
@section('content')
    <a href="{{url('admin/category')}}"><button type="submit" class="btn btn-success">Back</button></a>
    <h1>Detail Category</h1>
    @if($errors -> any())
        <h1>Errors :</h1>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{url('/admin/category/doedit')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="mb-3">
            <label  class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{$category->name}}" aria-describedby="emailHelp">
            @error('name')
                <div class="error"> {{$message}} </div> <br>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
    </form>
    @if (Session::has('pesan'))
        @php($pesan = Session::get('pesan'))
        @if ($pesan['tipe'] == 0)
            <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
        @else
            <div class="alert alert-success">{{ $pesan['isi'] }}</div>
        @endif
    @endif

@endsection
