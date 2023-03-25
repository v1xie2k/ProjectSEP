@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">
@endsection
{{-- @section('adminlte_css')
<style>
.nav{
    padding: 0;
    height: 8vh;
    width: 100%;
    display: flex;
    justify-content: flex-start;
    margin: 0;
    position: fixed;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1
}
.logo{
    height: 8vh;
}

.ar {
    color: #ffffff;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
    line-height: 42px;
}
</style>
@endsection --}}
@section('body')
@include('navbar2')
    <div class="product2">
        
        <h1>List Menu</h1>
        <a href="{{ url('admin/transaction/doExportExcel') }}" class="btn btn-success">Export Excel</a>
        <div class="card-body">
            <table class="table responsive" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">Id</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Ekspedisi</th>
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Detail</th>
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
                url: "{{ url('admin/transaction/ltrans') }}",
            },
            'columnDefs': [ {
                'targets': [5], /* column index */
                'orderable': false, /* true or false */
                }],
            columns: [
                { data: 'id', name: 'id' ,className:'hitam'},
                { data: 'email', name: 'email', className:'hitam'},
                { data: 'ekspedisi', name: 'ekspedisi', className:'hitam'},
                { data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' ),className: "text-right hitam" },
                { data: 'date', name: 'date' ,className:'hitam text-right'},
                { data: 'btnDetail', name: 'btnDetail' ,className:'hitam text-center'}
            ]
        });
    });
</script>
@stop
