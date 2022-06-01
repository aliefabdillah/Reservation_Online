@extends('adminTemplate.v_template')

@section('content')
    <!-- Modal Insert Start-->
    <div class="modal fade" id="formInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tempat Duduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('addSeat') }}" method="post">
                    @csrf
                    <div class="container-md p-4 my-3 border">
                        <div class="row">
                            <p>Kode Tempat Duduk</p>  
                            <input class="form-control" type="text" name="kodeSeat">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input class="btn btn-success" type="submit" name="submit" value="Add">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal Insert End-->

    <!-- Modal Edit Start-->
    <div class="modal fade" id="formEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Tempat Duduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('editSeat') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="container-md p-4 my-3 border">
                        <div class="row">
                            <p>Kode Tempat Duduk</p>  
                            <input class="form-control" type="text" id="updateIdSeat" name="updateIdSeat" hidden>
                            <input class="form-control" type="text" id="updateKodeSeat" name="updateKodeSeat">
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
    <!-- Modal Edit End-->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Tempat Duduk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Tempat Duduk</li>
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
                    <form action="{{ route('searchSeat') }}" method="get">
                        @csrf
                        <h2 class="Head-index"></h2>
                        <label class="ms-3">Cari : </label> 
                        <input id="search" type="text" name='search' placeholder="cari...">
                        <input class="btn btn-success btn-sm" type="submit" name='submit'>
                        <a href="{{ route('showTmptDuduk') }}"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
                    </form>
                </div>
                <div class="col-sm-6">
                    <button type='button' class='btn btn-primary float-sm-right me-5' data-bs-toggle="modal" data-bs-target="#formInsert"> + Tambah Baru </button><br>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th class="d-none">Id</th>
                        <th>Kode Tempat Duduk</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($seats as $seat)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <!-- <td><a href="">{{$seat->nama}}</a></td> -->
                            <td class="d-none">{{$seat->id}}</td>
                            <td>{{$seat->nama}}</td>
                            @if($seat->is_available == 1)
                                <td class="text-success text-uppercase fw-bolder">Tersedia</td>
                            @else
                                <td class="text-danger text-uppercase fst-italic fw-bolder">Dipesan</td>
                            @endif
                            <td>
                                <div class="d-flex flex-row">
                                    <form class="" action="{{ route('updateStatusSeat', ['seatId' => $seat->id]) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <input type='submit' name="submit" value="Change Status" class='btn btn-info btn-sm me-3'>
                                    </form>
                                    <button type='button' class='btn btn-warning btn-sm me-3 editBtn' data-bs-toggle="modal" data-bs-target="#formEdit"> Edit</button>
                                    <form class="" action="{{ route('deleteSeat', ['seatId' => $seat->id]) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type='submit' name="submit" value="Delete" class='btn btn-danger btn-sm me-3'>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="6" class="text-center">Tidak ada data...</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection