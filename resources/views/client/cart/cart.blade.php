@extends('layouts.layout')
@section('content')
@include('navbar')

    @php
        $total = 0;
        $qty = 0;
    @endphp

    @foreach ($carts as $val)
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
                        <h1>Shopping Cart</h1>
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

                                @if ($carts != null)
                                    @foreach ($carts as $val)

                                    <tr>
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
                                            <p class="harganew">{{ 'Rp ' . number_format($val->Menus[0]->harga, 2, ',', '.') }}</p>
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
                    <form action="{{ url('home/cart/transaction/process') }}" method="post" style="width: 90%;">
                        @csrf
                        <div class="textCart3">

                            <div class="t2">
                                Total
                            </div>
                            <div class="t3">
                                {{ 'Rp ' . number_format($total, 2, ',', '.') }}
                                {{-- {{ $total }} --}}
                            </div>

                        </div><br>

                        <div class="textCart3">
                            <div class="t1" >
                                <select name="id_ekspedisi" id="ekspedisi" style="color: #ebcdba; background:none;border: none;background-color: black;">
                                    @foreach ($ekspedisis as $val)
                                        <option value="{{ $val->id }}"> {{ $val->name }} -
                                            {{ 'Rp ' . number_format($val->ongkir, 2, ',', '.') }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>
                        <div class="textCart3">
                            <label for="alamat" style="padding-right: 20px" id="pilihAlamatlabel" hidden>Pilih Alamat Pengiriman :</label>
                        </div>

                        <div class="textCart3">

                            <select name="alamat" id="alamat" hidden>
                                @foreach ($alamats as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                                    <option value="other">Tambah alamat baru</option>
                            </select>
                        </div>

                        <div class="textCart3">
                            <label for="alamat" style="padding-right: 20px" id="tambahAlamat" hidden>Tambah Alamat Pengiriman Baru :</label>
                        </div>

                        <div class="textCart3">
                            <input type="text" name="alamatBaru" id="alamatBaru" hidden>
                        </div>
                        <div class="textCart3">
                            <label for="waktu_pengiriman">Delivery Time</label>
                        </div>
                        <div class="textCart3">
                            <input type="datetime-local" id="waktu_pengiriman" name="waktu_pengiriman">
                        </div>
                        <br>


                        <hr>
                        <label style="color: #ebcdba">Note: Shipping Cost have not been added to Grand Total</label>

                        {{-- <div class="textCart3">

                            <div class="t1">
                                Grand Total
                            </div>
                            <div class="t3">
                                <p id="grand_total">{{ $total }}</p>

                            </div>
                        </div> --}}

                        <button class="buttonco" name="order">Check Out</button>
                        <input type="hidden" name="id_user" value="{{ getYangLogin()->id }}">
                        <input type="hidden" name="total" value="{{ $total }}">
                        {{-- <input type="hidden" name="total" value="{{ 'Rp ' . number_format($total, 2, ',', '.') }}"> --}}
                        <input type="hidden" name="quantity" value="{{ $qty }}">
                        <input type="hidden" name="address" value="{{ getYangLogin()->alamat }}">
                    </form>
                </div>
            </div>
        </center>
        <!-- DETAIL CART  -->

    </div>


@endsection

@section('adminlte_js')
<script>
   $(function(){
        const d = new Date();
        let year = d.getFullYear();
        let day = d.getDate();
        let month = d.getMonth() +1;
        if(month<10){
            month = "0"+month
        }
        let hour = d.getHours();
        let minutes = d.getMinutes();
        if(minutes<10){
            minutes = "0"+minutes
        }
        const dateNow = year+"-"+month+"-"+day+"T"+hour+":"+minutes;
        const dateControl = document.querySelector('input[type="datetime-local"]');
        dateControl.value = dateNow;
        dateControl.min = dateNow;


    });
    $('select').on('change', function() {

        if (this.value == 1) {
            document.getElementById("alamatBaru").hidden = true
            document.getElementById("tambahAlamat").hidden = true
            document.getElementById("pilihAlamatlabel").hidden = true
            document.getElementById("alamat").hidden = true
        }
        else if(this.value > 1){
            $('#alamatBaru').removeAttr('hidden');
            $('#tambahAlamat').removeAttr('hidden');
            $('#pilihAlamatlabel').removeAttr('hidden');
            $('#alamat').removeAttr('hidden');
        }
        else{

        }
    });

</script>
@stop
