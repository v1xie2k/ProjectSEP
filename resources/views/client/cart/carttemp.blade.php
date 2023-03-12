@extends('layouts.layout')
@section('content')
    <h1>Isi Cart anda</h1>
    @php
        $total = 0;
        $qty = 0;
    @endphp
    @foreach ($carts as $val)
    @php
        $total += $val->subtotal;
        $qty += $val->quantity;
    @endphp
    <div class="" style="width: 18rem;">
        @foreach ($picts as $pict )
            @if (explode('.',$pict)[0]== $val->Menus[0]->id)
            <img src="{{asset('storage/items/'.$pict)}}" class="card-img-top" alt="...">
            @endif
        @endforeach
        <div class="card-body">
        <h5 class="card-title">{{$val->Menus[0]->name}}</h5>
        <p class="card-text">Price: {{$val->Menus[0]->harga}}</p>
        <p class="card-text">Desc: {{$val->Menus[0]->deskripsi}}</p>
        <p class="card-text">Quantity: {{$val->quantity}}</p>
        <p class="card-text">Total : {{$val->subtotal}}</p>
        <form action="{{url('home/cart/decrease/'.$val->id_menu)}}" method="post">
            @csrf
            <button class="btn btn-primary">-</button>
        </form>
        <br>
        <form action="{{url('home/cart/increase/'.$val->id_menu)}}" method="post">
            @csrf
            <button class="btn btn-primary">+</button>
        </form>
        <br>
        <form action="{{url('home/cart/deleteItem/'.$val->id_menu)}}" method="post">
            @csrf
            <button class="btn btn-primary">delete</button>
        </form>
        <br>
        </div>
    </div>
    @endforeach
    <hr>
    <h3>Saldo anda : {{getYangLogin()->saldo}}</h3>
    <h3>Total Item : {{$qty}}</h3>
    <h3>Total Price : {{$total}}</h3>
    <form action="{{url('home/cart/buy/'.getYangLogin()->id)}}" method="post">
        @csrf
        <select name="id_ekspedisi" id="ekspedisi">
            @foreach ($ekspedisis as $val)
                <option value="{{$val->id}}"> {{$val->name}} - {{$val->ongkir}} </option>
            @endforeach
        </select>
        <button class="btn btn-primary">Bayar</button>
        <input type="hidden" name="id_user" value="{{getYangLogin()->id}}">
        <input type="hidden" name="total" value="{{$total}}">
        <input type="hidden" name="quantity" value="{{$qty}}">
    </form>
    @if (Session::has('msg'))
    @php($msg = Session::get('msg'))
    @if ($msg['type'] == 0)
        <div class="alert alert-danger">{{ $msg['isi'] }}</div>
    @else
        <div class="alert alert-success">{{ $msg['isi'] }}</div>
    @endif
@endif
@endsection

@foreach ($carts as $val)
                                    {{-- @php
                                        $total += $val->subtotal;
                                        $qty += $val->quantity;
                                    @endphp --}}
                                    <td>
                                        <div class="gmbr_cart"><img
                                                src="{{ asset('storage/items/' . $val->id_menu . '.jpg') }}"
                                                class="gmbr_cart" alt="..."></div>
                                    </td>
                                    <td>{{ $val->Menus[0]->name }} <br> {{ $val->Menus[0]->deskripsi }}</td>
                                    <td>
                                        <div style="display: flex; flex-direction: row; justify-content:flex-start;"
                                            class="value">
                                            <form action="{{ url('home/cart/decrease/' . $val->id_menu) }}"
                                                method="post" style="width: 20px; height: 20px; margin-right:20px;"
                                                class="minus">
                                                @csrf
                                                <button class="buttoncart btn_cart_minus"
                                                    name="btn_cart_minus">-</button>
                                            </form>

                                            <p class="val"
                                                style="width: 30px; height: 20px; text-align: center;">
                                                {{ $val->quantity }}</p>

                                            <form action="{{ url('home/cart/increase/' . $val->id_menu) }}"
                                                method="post" style="width: 20px; height: 20px; margin-left:20px;">
                                                @csrf
                                                <button class="buttoncart btn_cart_plus"
                                                    name="btn_cart_plus">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="harganew">{{ $val->Menus[0]->harga }}</p>
                                    </td>
                                    <td>
                                        <p class="totalnew">{{ $val->subtotal }}</p>
                                    </td>
                                @endforeach
