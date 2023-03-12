@extends('layouts.layout')
@section('content')
@include('navbar')
    {{-- Temporary category list <br>
    <div class="d-flex flex-wrap">
        @foreach ($categories as $val)
        @foreach ($picts as $pict)
            @if (explode('.',$pict)[0] == $val->id)
            <img src="{{asset('storage/categories/'.$pict)}}" class="card-img-top" alt="..." style="width:200px;height:200px;">
            @endif
        @endforeach
        <a href="{{url('home/menu/'.$val->id)}}"><button>{{$val->name}}</button></a>
    @endforeach
    </div> --}}

    <div class="product">
        <center>
            <div class="htop">
                <p>Pick Category</p>
            </div>
            <div class="path"></div>

            <div class="cards">

                @foreach ($categories as $val)
                    {{-- @foreach ($picts as $pict) --}}
                    <a class="circle" href="{{url('home/menu/'.$val->id)}}">
                        {{-- @if (explode('.',$pict)[0] == $val->id) --}}
                            <img src="{{asset('storage/categories/'.$val->id.'.jpg')}}" class="card-img-top" alt="...">
                            <div class="overlay">
                                <h2>{{$val->name}}</h2>
                            </div>
                        {{-- @endif --}}
                    </a>
                @endforeach
            </div>

            @if (Session::has('pesan'))
            @php($pesan = Session::get('pesan'))
            @if ($pesan['tipe'] == 0)
                <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $pesan['isi'] }}</div>
            @endif
        @endif
        </center>
    </div>
@endsection
