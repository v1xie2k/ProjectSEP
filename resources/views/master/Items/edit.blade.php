@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection

@section('body')
@include('navbar2')

    <div class="productedit">
        <h1>Edit Item</h1>
        @if ($errors->any())
            <h1>Errors :</h1>

            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        @endif
        <label for="id_kategori">Old Photo</label><br>
        <img src="{{asset('storage/items/'.$item->id.'.jpg')}}" class="card-img-top" alt="..." style="width:200px;height:200px;">
        <br><br>
        <form action="{{ url('/admin/menu/doedit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="id_kategori">Choose a category:</label>
                <select name="id_kategori" id="category">
                    @foreach ($categories as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $item->name }}"
                    aria-describedby="emailHelp">
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
                <label class="form-label">Price</label>
                <input type="number" name="harga" class="form-control" min:1 value="{{ $item->harga }}">
                @error('harga')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="deskripsi" class="form-control" value="{{ $item->deskripsi }}"
                    aria-describedby="emailHelp">
                @error('deskripsi')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form><br>

    </div>

@endsection

