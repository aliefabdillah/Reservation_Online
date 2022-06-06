@extends('adminTemplate.v_template')

@section('content')
    <!-- Modal Insert Start-->
    <div class="modal fade" id="formInsertMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Makanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('addMenu', ['kategori' => 'makanan']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container-md p-4 my-3 border">
                        <div class="row mb-3">
                            <label>Nama Makanan</label>  
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="sate" value="{{ old('nama') }}">
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label>Harga</label>  
                            <input class="form-control @error('harga') is-invalid @enderror" type="text" name="harga" placeholder="12XXX" value="{{ old('harga') }}">
                            @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label>Stok</label>  
                            <input class="form-control @error('stok') is-invalid @enderror" type="text" name="stok" placeholder="100" value="{{ old('stok') }}">
                            @error('stok')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label>Foto</label>  
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                            @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
    <div class="modal fade" id="formEditMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Makanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('editMenu', ['kategori' => 'makanan']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="container-md p-4 my-3 border">
                        <input class="form-control" type="text" name="id" id="fid" hidden>
                        <div class="row mb-3">
                            <label>Nama Makanan</label>  
                            <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama" id="fnamaMenu">
                            @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label>Harga</label>  
                            <input class="form-control @error('harga') is-invalid @enderror" type="text" name="harga" id="fharga">
                            @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label>Stok</label>  
                            <input class="form-control  @error('stok') is-invalid @enderror" type="text" name="stok" id="fstok">
                            @error('stok')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label>foto</label>  
                            <input class="form-control  @error('foto') is-invalid @enderror" type="file" name="foto" id="ffoto">
                            @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                <h1>List Makanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Makanan</li>
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
                    <form action="{{ route('searchMenu', ['kategori' => 'makanan']) }}" method="get">
                        @csrf
                        <h2 class="Head-index"></h2>
                        <label class="ms-3">Cari : </label> 
                        <input id="search" type="text" name='search' placeholder="cari...">
                        <input class="btn btn-success btn-sm" type="submit" name='submit'>
                        <a href="{{ route('showMakanan') }}"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
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
                        <th>No</th>
                        <th class="d-none">Id</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($foods as $food)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td class="d-none">{{$food->id}}</td>
                            <td>{{$food->nama}}</td>
                            <td>RP. {{$food->harga}},-</td>
                            <td>{{$food->stok}}</td>
                            <td><img src="{{ url('/img/'.$food->foto) }}" width="50px" height="50px"></td>
                            <td>
                                <div class="d-flex flex-row">
                                    <button type='button' class='btn btn-warning btn-sm me-3 editBtnMenu' data-bs-toggle="modal" data-bs-target="#formEditMenu"> Edit</button>
                                    <form class="" action="{{ route('deleteMenu', ['menuId' => $food->id]) }}" method="post">
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