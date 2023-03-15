@extends('layouts.layout')
@include('navbar')
@section('content')

<div class="login1">
    <div class="log2">
        <h2>Login</h2><br><br>
        <form action="{{url('/forgotPass')}}" method="post">
            @csrf
            <label>Enter Email Address</label>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="email"><br>
            @error('email')
                <div class="error"> {{$message}} </div> <br>
            @enderror
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>

    </div>
</div>
@endsection
