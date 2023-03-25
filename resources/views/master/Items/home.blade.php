@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection
@section('body')
@include('navbar2')
    <div class="product">
        <h1>Page Item</h1>
        @if ($errors->any())
            <h1>Errors :</h1>

            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        @endif


        <form action="{{ url('/admin/menu/docreate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="id_kategori">Choose a category:</label>
                <select name="id_kategori" id="category">
                    @foreach ($categories as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                    aria-describedby="emailHelp" style="width: 117%;">
                @error('name')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Pict</label>
                <input type="file" name="photo" class="form-control" value="{{ old('photo') }}"
                    aria-describedby="emailHelp" style="width: 117%;">
                @error('photo')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="harga" class="form-control" min:1 value="{{ old('harga') }}" style="width: 117%;">
                @error('harga')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}"
                    aria-describedby="emailHelp" style="width: 117%;">
                @error('deskripsi')
                    <div class="error"> {{$message}} </div> <br>
                @enderror
            </div>
            <button type="submit" class="btn btn-success" style="width: 117%;">Add</button>
        </form><br>
        @if (Session::has('pesan'))
            @php($pesan = Session::get('pesan'))
            @if ($pesan['tipe'] == 0)
                <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $pesan['isi'] }}</div>
            @endif
        @endif
        <br><br>
        <h1>List Menu</h1>
        <div class="card-body">
            <table class="table responsive" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Kategori</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Pict</th>
                        <th>Action</th>
                    </tr>
                </thead>
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
                url: "{{ url('admin/menu/lprod') }}",
            },
            'columnDefs': [ {
                'targets': [5,6], /* column index */
                'orderable': false, /* true or false */
                }],
            columns: [
                { data: 'id', name: 'id' ,className:'hitam'},
                { data: 'name', name: 'name', className:'hitam'},
                { data: 'kategori', name: 'kategori' ,className:'hitam'},
                { data: 'harga', name: 'harga', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' ),className: "text-right hitam" },
                { data: 'deskripsi', name: 'deskripsi', className:'hitam'},
                { data: 'picture', name: 'picture' ,className:'hitam'},
                { data: 'btnDelete', name: 'btnDelete' ,className:'hitam'}
            ]
        });
    });
</script>
@stop
