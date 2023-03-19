@extends('layouts.layout')
@section('content')
@include('navbar')
<div class="bgSushi" style="height: 95vh;">
    <center>
        <div class="htop color">
            <p>{{ $category->name }}</p>
        </div>
        <div class="path2"></div>
        <br>
    </center>

    <br>
    <div class="tempMenu with-border-image bg">
        @foreach ($items as $val)
            <div class="menue" style = "padding-top:10px;">
                <img src="{{ asset('storage/items/' . $val->id . '.jpg') }}" class="card-img-top" alt="..." style="width: 250px;height:200px;">
                <div class="mdown">
                        <div style="width: 100%;height: 80px;" >
                            <div class="mdleft">
                                <div class="mname title99">{{ $val->name }}</div>
                                <div class="mdes">{{ $val->deskripsi }}</div>
                            </div>
                            <div class="mdright">
                                <div class="harga">{{  "Rp " . number_format($val->harga, 2, ",", ".")}}</div>
                                @if (isLogin())
                                <div class="addcart"><button class="btn_cart"><a href="{{ url('home/menu/addToCart/' . $val->id) }}" style="text-decoration:none; color: #774f34;">Add To Cart</a></button></div>
                                {{-- <a href="{{ url('home/menu/addToCart/' . $val->id) }}" class="addcart">Add To Cart</a><br> --}}
                                @endif
                            </div>
                            {{-- <div class="mname title99">{{ $val->name }}</div>
                            <div class="mdes">{{ $val->deskripsi }}</div>
                            <div class="harga">{{  "Rp " . number_format($val->harga, 2, ",", ".")}}</div>
                            @if (isLogin())
                                <a href="{{ url('home/menu/addToCart/' . $val->id) }}" class="addcart">Add To Cart</a><br>
                            @endif --}}
                        </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
