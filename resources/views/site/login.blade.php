@extends('layouts.layout')
@include('navbar')
@section('content')

<div class="login1">
    <div class="log2">
        <h2>Login</h2><br><br>
        <form action="{{url('/dologin')}}" method="post">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="email"><br>
            @error('email')
                <div class="error"> {{$message}} </div> <br>
            @enderror
            <label for="pass">Password:</label>
            <input type="password" name="password" id="pass"><br>
            @error('password')
                <div class="error"> {{$message}} </div> <br>
            @enderror
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>

        Dont have account ? <a href="{{url('register')}}"><button class="btn btn-success">Register Here</button></a>
        @if (Session::has('pesan'))
            @php($pesan = Session::get('pesan'))
            @if ($pesan['tipe'] == 0)
                <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $pesan['isi'] }}</div>
            @endif
        @endif

    </div>
</div>
@endsection
