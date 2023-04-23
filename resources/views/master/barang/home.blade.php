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

    <h1>New Item</h1>

        <form action="{{ url('/admin/barang/docreate') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                    aria-describedby="barangNama" style="width: 117%;">
                @error('name')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>

            <br>
            <button type="submit" class="btn btn-success" style="width: 117%;">Add</button>
        </form><br>
        <h1>List Stok Barang</h1>
        <div class="card-body">
            <table class="table responsive table-dark" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID User</th>
                        <th>Name</th>
                        <th>Stok</th>
                        {{-- <th style="text-align: center">Action</th> --}}
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($barang as $user)
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
                url: "{{ url('admin/barang/lbarang') }}",
            },
            'columnDefs': [ {
                'targets': [2], /* column index */
                'orderable': false, /* true or false */
                }],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'stok', name: 'stok' },
                // { data: 'btnDelete', name: 'btnDelete' }
            ]
        });
    });
</script>
@stop
