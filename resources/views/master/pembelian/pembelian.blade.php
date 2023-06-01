@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection
@section('body')
@include('navbar2')
    <div class="product">
        <h1>Form Pembelian</h1>
        @if ($errors->any())
            <h1>Errors :</h1>

            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        @endif


        <form action="{{ url('/admin/barang/doPembelian') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1>Bahan Baku</h1>
            <div class="row clearfix">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Sub Total</th>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Action</th>
                        </thead>

                        <tbody id="tbody">
                            <tr>
                                <td>
                                    <select name='items[]' class="form-control">
                                        @foreach ($item as $key => $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><input type="number" name='qty[]' placeholder='Enter Qty'
                                        class="form-control qty" step="0" min="1"/></td>
                                <td><input type="number" name='harga[]' placeholder='Enter Sub Total'
                                    class="form-control harga" step="0" min="1"/></td>
                                <td><input type="text" name='supplier[]' placeholder='Enter Supplier'
                                    class="form-control supplier" /></td>
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
            <button type="submit" class="btn btn-success" style="width: 117%;">Beli</button>
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

        <h1>List Pembelian</h1>
        <div class="card-body">
            <table class="table responsive" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-left">Item Name</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Sub Total</th>
                        <th class="text-left">Supplier</th>
                        <th class="text-left">Time</th>
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

        $('#tbody').on('click', '.remove', function() {

            var child = $(this).closest('tr').nextAll();
            $(this).closest('tr').remove();
            rowIdx--;
        });

        var table = $("#table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/barang/lpembelian') }}",
            },
            columns: [
                { data: 'name', name: 'name', className:'text-left' },
                { data: 'qty', name: 'qty' , className:'text-right'},
                { data: 'harga', name: 'harga', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' ) , className:'text-right'},
                { data: 'supplier', name: 'supplier' , className:'text-left' },
                { data: 'created_at', name: 'created_at' , className:'text-left' },
            ]
        });
    });
    function addClick() {
            var rowCount = $('#tab_logic tr').length;
            let html = `
                <tr>
                    <td>
                        <select name='items[]' class="form-control">
                                        @foreach ($item as $key => $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                    </td>
                    <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                    <td><input type="number" name='harga[]' placeholder='Enter Sub Total'
                                    class="form-control harga" step="0" min="1"/></td>
                                <td><input type="text" name='supplier[]' placeholder='Enter Supplier'
                                    class="form-control supplier" /></td>
                    <td>
                        <input type="button" value="Remove" class="btn btn-danger remove">
                    </td>
                </tr>
                `;
            $('#tbody').append(html);
        }
</script>
@stop
