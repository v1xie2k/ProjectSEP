@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection
@section('body')
@include('navbar2')
    <div class="productuser">

        @if (Session::has('pesan'))
        @php
            $pesan = Session::get('pesan');
        @endphp

        @if ($pesan['tipe'] == 1)
            <div class="alert alert-success">{{ $pesan['isi'] }}</div>
        @else
            <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
        @endif
    @endif

        <h1>List User</h1>
        <div class="card-body">
            <table class="table responsive table-dark" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID User</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Saldo</th>
                        <th style="text-align: center">Action</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->alamat}}</td>
                            <td>{{$user->saldo}}</td>
                            <td style="text-align: center"><a href="{{ url("admin/user/reset/".$user->id) }}"><button class="btn btn-warning m-2" >Reset Password</button></a> <a href="{{ url("admin/user/delete/".$user->id) }}"><button class="btn btn-danger">Delete</button></a> </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>


    </div>

@endsection

@section('plugins.Datatables', true)
@section('adminlte_js')
<script>
   $(function(){
        // console.log("test");
        var table = $("#table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/user/luser') }}",
            },
            'columnDefs': [ {
                'targets': [5], /* column index */
                'orderable': false, /* true or false */
                }],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'alamat', name: 'alamat' },
                { data: 'saldo', name: 'saldo' },
                { data: 'btnDelete', name: 'btnDelete' }
            ]
        });
    });
</script>
@stop
