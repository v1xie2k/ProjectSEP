<table>
    <thead>
        <tr>
            <th style="font-weight: bold;font-size: 20px;">ID Transaksi</th>
            <th style="font-weight: bold;font-size: 20px;">Tanggal Transaksi</th>
            <th style="font-weight: bold;font-size: 20px;">Nama Pembeli</th>
            <th style="font-weight: bold;font-size: 20px;">Ekspedisi</th>
            <th style="font-weight: bold;font-size: 20px;">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ \Carbon\Carbon::parse($row->created_at)->isoFormat('DD MMMM YYYY HH:mm') }}</td>
                <td>{{ $row->Users->name }}</td>
                <td>{{ $row->Ekspedisis->name}}</td>
                <td>{{ $row->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
