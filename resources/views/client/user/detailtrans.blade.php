@extends('layouts.layout')
@include('navbar')
@section('content')
<!-- awal profile -->
<div class="container_profile">
    <div class ="back_profile">
        <!-- atur profile kiri -->
        <div class="profile_left">
            <div class="picture_profile">
                @if ($picture)

                <img src="{{asset('storage/users/'.$picture)}}" class="card-img-top" alt="...">
                @endif
                <div class="profile"></div>
            </div>

            <div class="data_user">
                <h2 style="color: #ffffff;">Detail Transaksi</h2><br>
                <div class="top_up">
                        <div class="tabel_top_up">
                            <table>
                                <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Kategori</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $val )
                                    <tr>
                                        <td>{{$val->name_menu}}</td>
                                        <td>{{$val->Menus->Kategories->name}}</td>
                                        <td>{{$val->price}}</td>
                                        <td>{{$val->quantity}}</td>
                                        <td>{{$val->subtotal}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                    </div>
                </div>
                {{-- <a href="{{url('home/user/profile')}}"><button class="btn btn-primary" style="width:100%;">Back To Profile</button></a> --}}
            </div>
        </div>
        
        <!-- end profile kiri -->

        <!-- atur profile kanan -->
        <div class="profile_kanan">
            <h2 style="color: #ffffff;">Your Balance is : {{ 'Rp ' . number_format(getYangLogin()->saldo, 2, ',', '.') }}</h2><br>
            <div class="top_up">
                <h4>Masukan jumlah topup</h4>
                    <br>
                    @if (Session::has('msg'))
                        @php($msg = Session::get('msg'))
                            @if ($msg['tipe'] == 0)
                                <div class="alert alert-danger">{{ $msg['isi'] }}</div>
                            @else
                                <div class="alert alert-success">{{ $msg['isi'] }}</div>
                        @endif
                    @endif
                <form action="{{ url('home/user/topup') }}" method="post">
                    @csrf
                    <input type="text" inputmode="numeric" name="jum" id="" min="0">
                    @error('jum')
                        <div class="error"> {{$message}} </div> <br>
                    @enderror
                    <br>
                    <button class="tombol_top_up" name="topup">Top Up</button>
                </form>
                <br>
                <form action="{{url('home/user/profile')}}" method="get">
                    <input type="hidden" name="detail" value="(email)">
                    <a href="{{url('home/user/profile')}}"><button class="tombol_history">Back to profile</button></a>
                </form>
            </div>

            <br>
            <center>
            <h2 class="font_profile">Purchase History</h2>
            </center>

            <!-- tabelnya -->
            <div class="tabel_top_up">
                <table>
                    <thead>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Detail</th>
                    </thead>
                    <tbody>
                        @if ($htrans)
                            @foreach ($htrans as $val)
                                <tr id="tabel_history">
                                    <td>{{$val->date}}</td>
                                    <td>{{$val->total}}</td>
                                    <td><a href="{{url('home/user/history/trans/detail/'.$val->id)}}" class="btn btn-secondary">Detail</a></td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="2">You don't have any transaction history</td>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- end table -->
        </div>
        <!-- end profile kanan -->
    </div>
</div>
</div>
@endsection



{{-- @extends('layouts.layout')
@section('content')
    <div class="product6">
    <h1>Detail Tranksaksi</h1>
        <div class="card-body">
            <table class="table responsive table-dark" id="tableHasil">
                <thead class="thead-dark">
                <tr>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($details as $val )
                    <tr>
                        <td>{{$val->name_menu}}</td>
                        <td>{{$val->Menus->Kategories->name}}</td>
                        <td>{{$val->price}}</td>
                        <td>{{$val->quantity}}</td>
                        <td>{{$val->subtotal}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{url('home/user/profile')}}"><button class="btn btn-primary" style="width:100%;">Back To Profile</button></a>
        </div>
    </div>

@endsection --}}
