@extends('layouts.layout')
@section('content')
    <table border="1">
        <thead>
           <tr>
            <th>Total Transaksi</th>
            <th>Jumlah Item</th>
            <th>Tanggal Transaksi</th>
            <th>Ekspedisi</th>
            <th>Action</th>
           </tr>
        </thead>
        <tbody>
            @foreach ($histories as $val )
            <tr>
                <td>{{$val->total}}</td>
                <td>{{$val->quantity}}</td>
                <td>{{$val->date}}</td>
                <td>{{$val->Ekspedisis->name}}</td>
                <td>
                    <a href="{{url('home/user/history/trans/detail/'.$val->id)}}" class="btn btn-primary">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
