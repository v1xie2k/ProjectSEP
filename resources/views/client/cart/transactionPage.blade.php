@extends('layouts.layout')
@section('content')
@include('navbar')

    @php
        $total = 0;
        $qty = 0;
    @endphp

    @foreach ($item as $val)
        @php
            $total += $val->subtotal;
            $qty += $val->quantity;
        @endphp
    @endforeach

    <div class="cartbg bgcart">

        @if (Session::has('msg'))
            @php($msg = Session::get('msg'))
            @if ($msg['type'] == 0)
                <div class="alert alert-danger">{{ $msg['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $msg['isi'] }}</div>
            @endif
        @endif
        <!-- cart -->
        <center>
            <div class="cart blur2">
                <!--detail cart -->
                <div class="cleft">
                    <div class="textCart">
                        <h1>Item List</h1>
                    </div>
                    <div class="tabCart">
                        <table>
                            <thead>
                                <th colspan="2">PRODUCT DETAILS</th>
                                <th>QUANTITY</th>
                                <th>PRICE</th>
                                <th>TOTAL</th>
                            </thead>
                            <tbody>

                                @if ($item != null)
                                    @foreach ($item as $val)

                                    <tr>
                                        <td>
                                            <div class="gmbr_cart"><img
                                                    src="{{ asset('storage/items/' . $val->id_menu . '.jpg') }}"
                                                    class="gmbr_cart" alt="..."></div>
                                        </td>
                                        <td>{{ $val->name_menu }}</td>
                                        <td>
                                            <div style="display: flex; flex-direction: row; justify-content:flex-start;"
                                                class="value">
                                                <p class="val"
                                                    style="width: 30px; height: 20px; text-align: center;">
                                                    {{ $val->quantity }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="harganew">{{ 'Rp ' . number_format($val->price, 2, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            {{-- {{ 'Rp ' . number_format($val->subtotal, 2, ',', '.') }} --}}
                                            <p class="totalnew">{{ 'Rp ' . number_format($val->subtotal, 2, ',', '.') }}</p>
                                        </td>
                                    </tr>

                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="5">Your Cart is Empty</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- summary -->
                <div class="cright blur2">
                    <div class="textCart4">ORDER SUMMARY</div>
                    <hr>
                    <form action="{{ url('home/cart/buy/' . getYangLogin()->id) }}" method="post" style="width: 90%;">
                        @csrf
                        <div class="textCart3">

                            <div class="t2">
                                Total
                            </div>
                            <div class="t3">
                                {{ 'Rp ' . number_format($total, 2, ',', '.') }}
                                {{-- {{ $total }} --}}
                            </div>
                        </div>
                        <div class="textCart3">
                            <div class="t2">
                                Shipping
                            </div>
                            <div class="t3">
                                {{$ekspedisi->name}} - {{ 'Rp ' . number_format($ekspedisi->ongkir, 2, ',', '.') }}
                            </div>
                        </div>
                        <hr>
                        Note: Shipping Cost have not been added to Grang Total
                        {{-- <div class="textCart3">

                            <div class="t1">
                                Grand Total
                            </div>
                            <div class="t3">
                                <p id="grand_total">{{ $total }}</p>

                            </div>
                        </div> --}}
                        <div class="textC4">
                            Your Balance is {{ 'Rp ' . number_format(getYangLogin()->saldo, 2, ',', '.') }}
                        </div>

                        <button class="buttonpay" name="order">Pay</button>
                        <input type="hidden" name="id_user" value="{{ getYangLogin()->id }}">
                        <input type="hidden" name="total" value="{{ $total }}">
                        {{-- <input type="hidden" name="total" value="{{ 'Rp ' . number_format($total, 2, ',', '.') }}"> --}}
                        <input type="hidden" name="quantity" value="{{ $qty }}">
                        <input type="hidden" name="htrans" id="htrans" value="{{$htrans}}">
                        <input type="hidden" name="item" id="item" value="{{$item}}">
                        <input type="hidden" name="ekspedisi" id="ekspedisi" value="{{$ekspedisi}}">
                    </form>
                </div>
            </div>
        </center>

    </div>


@endsection
