@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection
@section('body')
@include('navbar2')
    <div class="product">
        <h1>Page Rekonsiliasi</h1>
        @if ($errors->any())
            <h1>Errors :</h1>

            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        @endif


        <form action="{{ url('/admin/rekonsiliasi/docreate') }}" method="post">
            @csrf
            <h1>Resep</h1>
            <div class="row clearfix">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Action</th>
                        </thead>

                        <tbody id="tbody">
                            <tr>
                                <td>
                                    <select name='items[]' class="form-control">
                                        @foreach ($item as $key => $i)
                                            <option value="{{ $i->id }}-{{$i->name}}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><input type="number" name='qty[]' placeholder='Enter Qty'
                                        class="form-control qty" step="0" min="1"/></td>
                                <td>
                                    <input type="button" value="Remove" class="btn btn-danger remove">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="btn btn-default pull-left" id="addBtn" type="button" onclick="addClick()" style="width: 300px">
                Add Row
            </button>

            <br><br>
            <button type="submit" class="btn btn-success" style="width: 117%;">Tutup toko</button>
        </form><br>
        @if (Session::has('pesan'))
            @php($pesan = Session::get('pesan'))
            @if ($pesan['tipe'] == 0)
                <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $pesan['isi'] }}</div>
            @endif
        @endif
        <h1>Daftar Rekonsiliasi Stock</h1>
        <form action="{{ url('/admin/rekonsiliasi/filterDate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="id_kategori">Choose a Date Range:</label>
                <input type="date" name="start" id="" value="{{ \carbon\carbon::parse($start)->isoFormat("YYYY-MM-DD")}}">
                <label for="id_kategori"> &nbsp; To  &nbsp;</label>
                <input type="date" name="end" id="" value="{{ \carbon\carbon::parse($end)->isoFormat("YYYY-MM-DD")}}">
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-success" style="height: 30px; width:100px; line-height:0px; ">Filter</button>
            </div>
        </form>
        <div class="grid gap-3 column-gap-3">
            @foreach ($rekonsiliasi as $value)
            <div class="card" style="width: 18rem; color:black;">
                <div class="card-body">
                  <h5 class="card-title">Nama Item:{{$value->name}}</h5>
                  <h6 class="card-text">Stok Sebelumnya:{{$value->lastqty}}</h6>
                  <h6 class="card-text">Stok Sekarang:{{$value->qty}}</h6>
                  <b class="card-text">{{ \carbon\carbon::parse($value->created_at)->isoFormat("YYYY-MM-DD")}}</b>
                </div>
            </div>
            @endforeach
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
                url: "{{ url('admin/rekonsiliasi/lprod') }}",
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
                { data: 'resep', name: 'resep' ,className:'hitam'},
                { data: 'picture', name: 'picture' ,className:'hitam'},
                { data: 'btnDelete', name: 'btnDelete' ,className:'hitam'}
            ]
        });

        $('#tbody').on('click', '.remove', function() {

            var child = $(this).closest('tr').nextAll();
            $(this).closest('tr').remove();
            rowIdx--;
        });
    });
    function addClick() {
            var rowCount = $('#tab_logic tr').length;
            let html = `
                <tr>
                    <td>
                        <select name='items[]' class="form-control">
                                        @foreach ($item as $key => $i)
                                            <option value="{{ $i->id }}-{{$i->name}}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                    </td>
                    <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                    <td>
                        <input type="button" value="Remove" class="btn btn-danger remove">
                    </td>
                </tr>
                `;
            $('#tbody').append(html);
        }
</script>
@stop
