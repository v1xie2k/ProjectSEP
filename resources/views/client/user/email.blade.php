<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h1>Invoice For  - {{getYangLogin()->name}}</h1><br>
    <h4>Transaction Date : {{date("d-m-Y", strtotime($tanggal))}}</h4>
    <h4>Transaction Time : {{date("H:i:s", strtotime($tanggal))}}</h4>
    <hr><br>
    <h2>Here's some summary of your order</h2><br>
    <table border="1">
        <thead>
            <tr>
                <th>Menu Name</th>
                <th>Menu Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarItems as $val)
                @php
                    $dtrans = $val;
                @endphp
                <tr>
                    <td>{{$val->name_menu}}</td>
                    <td>{{$val->Menus->Kategories->name}}</td>
                    <td>{{ 'Rp ' . number_format($val->price, 2, ',', '.') }}</td>
                    <td>{{$val->quantity}}</td>
                    <td>{{ 'Rp ' . number_format($val->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table><br>
    {{-- Status udah bayar atau belum  alamat pengiriman jg belum--}}
    <h4>Courir of choice: {{$dtrans->Htrans->Ekspedisis->name}} - {{ 'Rp ' . number_format($dtrans->Htrans->Ekspedisis->ongkir, 2, ',', '.') }}</h4><br>
    @if ($dtrans->Htrans->Ekspedisis->id != 5)
        <h4>Alamat: {{$dtrans->Htrans->alamat}}</h4>
    @endif
    <h4>Transaction Status:
        @if($dtrans->Htrans->status_trans == 1)
            <span style="color:rgb(255, 128, 0);">Pending</span>
        @elseif ($dtrans->Htrans->status_trans == 100)
            <span style="color:rgb(15, 144, 15);">Success</span>
        @else
            <span style="color:rgb(168, 12, 12);">Canceled</span>
        @endif
    </h4>
    <h3>Thanks For Your Order</h3>
    <h3>ありがとうございました</h3>
</body>
</html>
