@extends('layouts.layout')
@section('content')
@include('navbar2')
    <a href="{{url('admin/menu')}}"><button type="submit" class="btn btn-success">Back</button></a>
    <h1>Detail Item</h1>
    @if($errors -> any())
        <h1>Errors :</h1>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{url('/admin/menu/doedit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$menu->id}}">
        <div class="mb-3">
            <label for="id_kategori">Choose a category:</label>
            <select name="id_kategori" id="category">
                @foreach ($categories as $value)
                @if ($value->id == $menu->id_kategori)
                    <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                @else

                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endif

                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{$menu->name}}" aria-describedby="emailHelp">
            @error('name')
                <div class="error"> {{$message}} </div> <br>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Pict</label>
            <input type="file" name="photo" class="form-control" value="{{ old('photo') }}"
                aria-describedby="emailHelp">
            @error('photo')
                <div class="error"> {{$message}} </div> <br>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">harga</label>
            <input type="number" name="harga" class="form-control" min:1 value="{{$menu->harga}}" >
            @error('harga')
                <div class="error"> {{$message}} </div> <br>
            @enderror
        </div>
        <div class="mb-3">
            <label  class="form-label">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" value="{{$menu->deskripsi}}" aria-describedby="emailHelp">
            @error('deskripsi')
                <div class="error"> {{$message}} </div> <br>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
        <input type="hidden" name="pict" value="{{$picture}}">
    </form><br>
    <label  class="form-label">Item Pict</label>
    <div class="card" style="width: 18rem;">
        <img src="{{asset('storage/items/'.$picture)}}" class="card-img-top" alt="...">
    </div>
    @if (Session::has('pesan'))
        @php($pesan = Session::get('pesan'))
        @if ($pesan['tipe'] == 0)
            <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
        @else
            <div class="alert alert-success">{{ $pesan['isi'] }}</div>
        @endif
    @endif

@endsection
