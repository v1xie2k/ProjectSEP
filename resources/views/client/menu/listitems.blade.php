@extends('layouts.layout')
@section('content')
@include('navbar')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="bgSushi" style="height: 95vh;">
    <center>
        <div class="htop color">
            <p>{{ $category->name }}</p>
        </div>
        <div class="path2"></div>
        <br>
    </center>
        <div class="form-group">
            {{-- <label for="exampleInputPassword">Supplier</label> --}}
            <input type="text" class="form-control" placeholder="Cari Menu" id="Search" name="Search">
            <input type="hidden" id="id" name="id" value="{{$id}}">
            @if(isLogin())
                <input type="hidden" name="loginUser" id="loginUser" value="ada">
            @endif
            <br>

            <div id="result" class="tempMenu with-border-image bg">

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
                            <div class="mdright">
                                <div class="harga">{{  "Rp " . number_format($val->harga, 2, ",", ".")}}</div>
                                @if (isLogin())
                                <div class="addcart"><button class="btn_cart"><a href="{{ url('home/menu/addToCart/' . $val->id) }}" style="text-decoration:none; color: #774f34;">Add To Cart</a></button></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
            </div>
            @error('Search')
                <div class="error RedText">{{ $message }}</div>
            @enderror
        </div>
</div>
<script>
    function separateComma(val) {
    var sign = 1;
    if (val < 0) {
        sign = -1;
        val = -val;
    }
    let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
    let len = num.toString().length;
    let result = '';
    let count = 1;

    for (let i = len - 1; i >= 0; i--) {
        result = num.toString()[i] + result;
        if (count % 3 === 0 && count !== 0 && i !== 0) {
        result = ',' + result;
        }
        count++;
    }
    if (val.toString().includes('.')) {
        result = result + '.' + val.toString().split('.')[1];
    }
    return sign < 0 ? '-' + result : result;
    }

    $( document ).ready(function() {

    $('#Search').on('keyup',function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var value = $(this).val()
        var id = $('#id').val()
        var login = $('#loginUser').val()

        $.ajax({
                type : 'POST',
                url : '/home/menu/cari-menu/'+id,
                dataType : 'json',
                data:{'search':value},

                success:function(data){

                    $("#result").empty();
                    console.log(data);
                    var temp = '<div class="menuContainer">';
                    for (let index = 0; index < data.length; index++) {
                        var id =  data[index]['id']
                        var syntaxAsset = '{{ asset("storage/items/") }}/'
                        syntaxAsset += id + '.jpg'
                        temp = temp + '<div class="menue" style = "padding-top:10px;">'
                        temp = temp + '<img src="' + syntaxAsset + '" class="card-img-top" alt="..." style="width: 250px;height:200px;">'
                        temp = temp + '<div class="mdown">'
                        temp = temp + '<div style="width: 100%;height: 80px;" >'
                        temp = temp + '<div class="mdleft">'
                        temp = temp + '<div class="mname title99">'+ data[index]['name'] +'</div>'
                        temp = temp + '<div class="mdes">'+ data[index]['deskripsi'] +'</div>'
                        temp = temp + '</div>'
                        temp = temp + '<div class="mdright">'
                        temp = temp + '<div class="harga">Rp' + separateComma(data[index]['harga'])+'</div>'
                        if(login == 'ada'){
                            var syntaxUrl = '{{ url("home/menu/addToCart/") }}/' + id
                            temp = temp+ '<div class="addcart"><button class="btn_cart"><a href="'+ syntaxUrl+'" style="text-decoration:none; color: #774f34;">Add To Cart</a></button></div>'
                        }
                        temp = temp + '</div>'
                        temp = temp + '</div>'
                        temp = temp + '</div>'
                        temp = temp + '</div>'
                    }
                    temp += "</div>";
                    $("#result").append(temp);
                    if(data.length==0){
                        $("#result").empty();
                    }
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        })
    });
</script>
@endsection
