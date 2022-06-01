<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">Menu</th>
            <th scope="col">Harga Satuan</th>
            <th scope="col">QTY</th>
            <th scope="col">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detail_orders as $data)
        <tr class="text-center">
            <td>{{$data->nama}}</td>
            <td>{{$data->harga}}</td>
            <td>{{$data->jumlah_pesan}}</td>
            <td>{{$data->total_harga}}</td>
        </tr>
        @endforeach
    </tbody>
</table>