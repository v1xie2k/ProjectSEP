@extends('layouts.layout')
@include('navbar')
@push('css')
<style>
    .login1{
    width: 100%;
    height: 120vh;
    background-color: rgba(0, 0, 0, 1);
    padding: 5vh;
    animation: move 30s infinite ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

@endpush
@section('content')

    <div class="login1" style="height: 97vh;">
        <div class="log2 blur">
            <h2>Registration</h2>

            <form action="{{ url('/doregister') }}" method="post">
                @csrf
                <input type="hidden" name="saldo" value=0>
                <input type="hidden" name="role" value="user">
                <div class="mb-3">
                    <label>Name: </label><br>
                    <input type="text" name="name" class="name" value="{{ old('name') }}"
                        aria-describedby="emailHelp" style="width: 100%;">
                    @error('name')
                        <div class="error"> {{$message}} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Email address: </label><br>
                    <input type="text" name="email" class="email" value="{{ old('email') }}"
                        aria-describedby="emailHelp" style="width: 100%;">
                    @error('email')
                        <div class="error"> {{$message}} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Password: </label><br>
                    <input type="password" name="password" class="password" style="width: 100%;">
                    @error('password')
                        <div class="error"> {{$message}} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Confirm Password: </label><br>
                    <input type="password" name="password_confirmation" class="password" style="width: 100%;">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat: </label><br>
                    <input type="text" name="alamat" class="alamat" value="{{ old('alamat') }}"
                        aria-describedby="emailHelp" style="width: 100%;">
                    @error('alamat')
                        <div class="error"> {{$message}} </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Register</button>
            </form>

            Already have account ? <a href="{{ url('login') }}"><button class="btn btn-primary">Login Here</button></a>
            <br>


        </div>
    </div>
@endsection
