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
                    <td>
                        <input type="button" value="Remove" class="btn btn-danger remove">
                    </td>
                </tr>
                `;
            $('#tbody').append(html);
        }
</script>
@stop
