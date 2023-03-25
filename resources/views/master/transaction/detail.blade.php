@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection

@section('body')
@include('navbar2')

    <div class="product2">

        <h1>Detail Transaction</h1>
        <div class="card-body">
            <table class="table responsive" id="table" border="1">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">Id</th>
                        <th style="text-align: center;">Nama Menu</th>
                        <th style="text-align: center;">Harga</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dtrans as $order)
                    <tr>
                        <td class="hitam">{{ $order->id_htrans }}</td>
                        <td class="hitam">{{ $order->name_menu }}</td>
                        <td style="text-align: right" class="hitam">{{  "Rp " . number_format($order->price, 2, ",", ".") }}</td>
                        <td style="text-align: right" class="hitam">{{ $order->quantity }}</td>
                        <td style="text-align: right" class="hitam">{{  "Rp " . number_format($order->subtotal, 2, ",", ".") }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


</div>

@stop


