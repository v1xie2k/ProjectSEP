@extends('layouts.layout')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" media="screen">
@endsection
@section('content')
    <div class="product6">
    <a href="{{url('home/user/profile')}}"><button class="btn btn-primary" style="width:9.5%;">Back To Profile</button></a><br>
    <br>
    @if (Session::has('pesan'))
            @php($pesan = Session::get('pesan'))
            @if ($pesan['tipe'] == 0)
                <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $pesan['isi'] }}</div>
            @endif
    @endif
    <h1>Edit Profile</h1>
        <label  class="form-label">Profile Picture</label>
        <div class="card" style="width: 13rem;">
            @if ($picture)
            <img src="{{asset('storage/users/'.$picture)}}" class="card-img-top" alt="..." style="width: 13rem; height: 13rem;">
            @endif
        </div>
        <form action="{{ url('home/user/doedit/'.getYangLogin()->id) }}" method="post" enctype="multipart/form-data" style="padding-top:300px; width:100%;">
            @csrf
            {{-- <input type="hidden" name="saldo" value=0>
            <input type="hidden" name="role" value="user"> --}}
            <div class="mb-3">
                <label>Name: </label><br>
                <input type="text" name="name" class="name" value="{{ getYangLogin()->name }}"
                    aria-describedby="emailHelp" style="width: 100%;">
                @error('name')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <div class="mb-3">
                <label>Email address: </label><br>
                <input type="text" name="email" class="email" value="{{ getYangLogin()->email }}"
                    aria-describedby="emailHelp" style="width: 100%;" disabled>
                @error('email')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat: </label><br>
                <input type="text" name="alamat" class="alamat" value="{{ getYangLogin()->alamat }}"
                    aria-describedby="emailHelp" style="width: 100%;">
                @error('alamat')
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
            <input type="hidden" name="pict" value="{{$picture}}">
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <br>

    </div>

@endsection
