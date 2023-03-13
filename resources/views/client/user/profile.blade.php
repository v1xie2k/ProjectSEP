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


    </div>
</div>
</div>
@endsection
