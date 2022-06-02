@extends('adminTemplate.v_template')

@section('content')
    <!-- Modal detail Start-->
    <div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detail_order">
            </div>
            </div>
        </div>
    </div>
    <!-- Modal detail End-->

    <!-- Modal Edit status Start-->
    <div class="modal fade" id="editStatusOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Status Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('changeStatusOrder') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="container-md p-4 my-3 border">
                        <div class="row">
                            <p>Status Order</p>  
                            <input class="form-control" type="text" id="idOrder" name="idOrder" hidden>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option selected hidden>Pilih Status...</option>
                                <option value=2>Datang</option>
                                <option value=3>Selesai</option>
                                <option value=4>Batal</option>
                                <option value=5>Tidak Datang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input class="btn btn-success" type="submit" name="submit" value="Update">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit status End-->

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
                    <form action="{{ route('searchOrder') }}" method="get">
                        @csrf
                        <h2 class="Head-index"></h2>
                        <label class="ms-1">Cari : </label>
                         
                        <input class="me-3" type="text" name='search' placeholder="cari...">
                        <span>/</span>
                        <input class="ms-3 me-2" type="date" name='searchDate'>
                    
                        <input class="btn btn-success btn-sm" type="submit" name='submit'>
                        <a href="{{ route('showOrder') }}"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                        <th>Order Id</th>
                        <th>Waktu Reservasi</th>
                        <th>Nama</th>
                        <th>Seat</th>
                        <th>Total Bayar</th>
                        <th>Sisa Bayar</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_orders as $order)
                        <tr class="text-center">
                            @php
                                $orderTime = date('H:i:s', strtotime($order->waktu_reservasi));
                                $currentTime = strtotime(date('H:i:s'));
                                $lateTime = strtotime($orderTime) + 900;
                            @endphp
                            <td>{{$order->id}}</td>
                            <td>{{$orderTime}}</td>
                            <td>{{$order->nama}}</td>
                            <td>{{$order->kode_seat}}</td>
                            <td>RP{{$order->total_harga}},-</td>
                            <td>RP{{$order->sisa}},-</td>
                            @if($order->payment_status == 1)
                                <td class="text-dark fw-bolder">PENDING</td>
                            @elseif($order->payment_status == 2)
                                <td class="text-success fw-bolder">SUCCESS</td>
                            @else
                                <td class="text-danger fw-bolder">EXPIRED</td>
                            @endif
                            @if($order->order_status == 1)
                                @if($currentTime < $lateTime)
                                    <td class="text-primary fw-bolder">NOT ARRIVED</td>
                                @else
                                    <td class="text-danger fw-bolder">TERLAMBAT</td>
                                @endif
                            @elseif($order->order_status == 2)
                                <td class="text-success fw-bolder">CONFIRMED</td>
                            @elseif($order->order_status == 3)
                                <td class="text-success fw-bolder">SELESAI</td>
                            @elseif($order->order_status == 4)
                                <td class="text-danger fst-italic">BATAL</td>
                            @else
                                <td class="text-danger fw-bolder">TIDAK DATANG</td>
                            @endif
                            <td>
                                <div class="d-flex flex-row">
                                    <a href="{{ route('detailOrder', ['orderId' => $order->id]) }}" type='button' class='btn btn-info btn-sm me-3 detailBtn'>Detail Pesanan</a>
                                    @if($order->order_status == 1 || $order->order_status == 2) 
                                        <button type='button' class='btn btn-warning btn-sm me-3 editStatusBtn' data-bs-toggle="modal" data-bs-target="#editStatusOrder">Edit Status</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="9" class="text-center">Tidak ada data...</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection