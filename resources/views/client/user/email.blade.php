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
                    <td>{{$val->price}}</td>
                    <td>{{$val->quantity}}</td>
                    <td>{{$val->subtotal}}</td>
                </tr>
            @endforeach
        </tbody>
    </table><br>
    <h4>Courir of choice: {{$dtrans->Htrans->Ekspedisis->name}}</h4><br>
    <h4>Last Balance: Rp.{{getYangLogin()->saldo}}</h4><br>
    <h3>Thanks For Your Order</h3>
    <h3>ありがとうございました</h3>
</body>
</html>
