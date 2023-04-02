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
