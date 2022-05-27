@extends('adminTemplate.v_template')

@section('content')
    <!-- Modal Detail Start-->
    <div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Menu</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!-- Modal Detaik End-->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Order</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @if(session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan')}}
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-sm-6">
                    <!-- buat form search  -->
                    <form action="" method="get">
                        @csrf
                        <h2 class="Head-index"></h2>
                        <label class="ms-3">Cari : </label> 
                        <input id="search" type="text" name='search' placeholder="cari...">
                        <input class="btn btn-success btn-sm" type="submit" name='submit'>
                        <a href="{{ route('showOrder') }}"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
                    </form>
                </div>
                <div class="col-sm-6">
                    <button type='button' class='btn btn-primary float-sm-right me-5' data-bs-toggle="modal" data-bs-target="#formInsertMenu"> + Tambah Baru </button><br>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Order Id</th>
                        <th>Waktu Reservasi</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Seat</th>
                        <th>Total Harga</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->waktu_reservasi}}</td>
                            <td>{{$order->nama}}</td>
                            <td>{{$order->telp}}</td>
                            <td>{{$order->kode_seat}}</td>
                            <td>RP{{$order->total_harga}},-</td>
                            <td>
                                <div class="d-flex flex-row">
                                    <button type='button' class='btn btn-info btn-sm me-3 detailBtn' data-bs-toggle="modal" data-bs-target="#detailOrder">Detail Pesanan</button>
                                    <form class="" action="{{ route('deleteOrder', ['orderId' => $order->id]) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <a href="#" name="submit" value="{{}}" class='btn btn-danger btn-sm me-3'>Detail</a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="7" class="text-center">Tidak ada data...</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection