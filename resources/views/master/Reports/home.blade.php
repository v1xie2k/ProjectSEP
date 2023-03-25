@extends('adminlte::master')
{{-- @include('navbar2') --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen">

@endsection

@section('body')
@include('navbar2')
    <div class="product">
        <h1>Report Page</h1>
        @if ($errors->any())
            <h1>Errors :</h1>

            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        @endif


        <form action="{{ url('/admin/report/filterDate') }}" method="post" enctype="multipart/form-data">
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
        {{-- @if (Session::has('pesan'))
            @php($pesan = Session::get('pesan'))
            @if ($pesan['tipe'] == 0)
                <div class="alert alert-danger">{{ $pesan['isi'] }}</div>
            @else
                <div class="alert alert-success">{{ $pesan['isi'] }}</div>
            @endif
        @endif --}}
        <br><br>
        <h2>Total Trans : {{$total_trans}} </h2>
        <h2>Total qty sold : {{$total_qty}}</h2>
        <h2>Total Income : {{ 'Rp ' . number_format($total_income, 2, ',', '.') }}</h2>
        <br>
        <table border="1">
            <thead>
                <th>User</th>
                <th>Courier</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
            </thead>
            <tbody>
                @foreach ($invoice as $val)
                    <tr>
                        <td>{{$val->Users->name}}</td>
                        <td>{{$val->Ekspedisis->name}}</td>
                        <td>{{$val->quantity}}</td>
                        <td>{{$val->total}}</td>
                        <td>{{$val->date}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <h1>Omzet Graph </h1>
        <div style="width: 100%; margin: auto;background-color: whitesmoke;border-radius: 10%;">
            <div style="width: 90%; margin: auto;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>



@endsection

@section('adminlte_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    $(function() {
    $.ajax({
        type: "GET",
        url: "{{ url('/admin/report/data') }}",
        success: function (response) {
            console.log(response);
            const data = {
                labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
                datasets: [{
                    label: "Omzet per bulan",
                    data: [
                        parseInt(response.Jan),
                        parseInt(response.Feb),
                        parseInt(response.Mar),
                        parseInt(response.Apr),
                        parseInt(response.Mei),
                        parseInt(response.Jun),
                        parseInt(response.Jul),
                        parseInt(response.Aug),
                        parseInt(response.Sep),
                        parseInt(response.Okt),
                        parseInt(response.Nov),
                        parseInt(response.Des)
                    ],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            };

            var ctx = $('#myChart');

            const config = {
                type: 'line',
                data: data,
            };

            var chart = new Chart(ctx, config);
        },
        error: function(xhr) {
            console.log(xhr.responseJSON);
        }
    });
  });
</script>
@endsection

