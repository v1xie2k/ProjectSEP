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

                <img src="{{asset('storage/users/'.$picture)}}" class="card-img-top" alt="..." style="width: 18rem; height: 18rem;">
                @endif
                <div class="profile"></div>
            </div>

            <div class="data_user">
                <!-- data user -->
                <h1>Name<span class="data_user_nama">: {{ getYangLogin()->name}}</span></h1><br>
                <h1>Email<span class="data_user_email">: {{ getYangLogin()->email}}</span></h1><br>
                <h1>Address<span class="data_user_alamat">: {{ getYangLogin()->alamat}}</span></h1><br>
                <h1>Weeb<span class="data_user_weeb">: {{ getYangLogin()->weeb}}</span></h1><br>
                <a href="{{url('home/user/editprofile/'.getYangLogin()->id)}}"><button class="tombol_edit_user">Edit Profile</button></a><br><br>
                <a href="{{url('home/user/editpassword/'.getYangLogin()->id)}}"><button class="tombol_edit_user">Edit Password</button></a>
                {{-- <form action="#" method="get">
                    <input type="hidden" name="edit" value="(email)">
                    <a href="{{url('home/user/editprofile/'.getYangLogin()->id)}}"><button class="tombol_edit_user">Edit Profile</button></a><br>
                    <a href="{{url('home/user/editpassword/'.getYangLogin()->id)}}"><button class="tombol_edit_user">Edit Password</button></a>
                </form> --}}
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
                <form action="{{url('home/user/history/topup')}}" method="get">
                    <input type="hidden" name="detail" value="(email)">
                    <a href="{{url('home/user/history/topup')}}"><button class="tombol_history">History Top Up</button></a>
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
                        <th>Time</th>
                        <th>Amount</th>
                        <th>Detail</th>
                    </thead>
                    <tbody>
                        @if ($htrans)
                            @foreach ($htrans as $val)
                                <tr id="tabel_history">
                                    <td>{{substr($val->created_at,0,10)}}</td>
                                    <td>{{substr($val->created_at,10,10)}}</td>
                                    <td>{{$val->total}}</td>
                                    @if ($val->status_trans == 1)
                                        <form action="{{url('home/cart/buy/'.$val->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="htrans" value="{{$val}}">
                                            <input type="hidden" name="type" value="pending">
                                            <td><button class="btn btn-success">Pay</button></td>
                                        </form>
                                    @else
                                        <td><a href="{{url('home/user/history/trans/detail/'.$val->id)}}" class="btn btn-secondary">Detail</a></td>
                                    @endif
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
