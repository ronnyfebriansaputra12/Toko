@extends('admins.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Tambah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('pesan_edit'))
        <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Edit
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('pesan_hapus'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"">
            Data Berhasil di Hapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg">
                <div class="row">

                    <!-- Recent Sales -->
                    <div class="col-12">

                        {{-- <button type="button" class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#basicModal">
                            +Tambah Barang
                          </button> --}}
                        <a href="/barang/create" type="button" class="btn btn-primary btn-sm mb-4">+Tambah Barang</a>
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Barang</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Barang</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Harga Barang</th>
                                            <th scope="col">Stok Barang</th>
                                            <th scope="col">Foto Barang</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangs as $barang)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $barang->kode_brg }}</td>
                                                <td>{{ $barang->nama_brg }}</td>
                                                <td>{{ $barang->harga_brg }}</td>
                                                <td>{{ $barang->stok_brg }}</td>
                                                <td>
                                                    @if ($barang->foto_brg)
                                                        {{-- <img id="myImg" style="max-width:80px; max-height:50px"
                                                            src="{{ url('images') . '/' . $barang->foto_brg }}"> --}}
                                                        <img id="myImg"
                                                            src="{{ url('images') . '/' . $barang->foto_brg }}"
                                                            alt="{{ $barang->nama_brg }}" style="max-width:80px">
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-link" data-bs-toggle="modal"
                                                        data-bs-target="#verticalycentered"><span
                                                            class="badge bg-info text-dark"><i
                                                                class="bi bi-info-circle"></i> Detail</span></button>

                                                    <a href="{{ url('/barang/' . $barang->id . '/edit/') }}"><span
                                                            class="badge bg-warning text-dark"><i
                                                                class="bi bi-pen-circle"></i> Edit</span></a>

                                                    <form onsubmit="return confirm('Yakin Akan Menghapus Data ??')" class="d-inline" action="{{ '/barang/'.$barang->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link"><span
                                                                class="badge bg-danger text-dark"><i
                                                                    class="bi bi-trash"></i> Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    {{ $barangs->links() }}
                </div>
            </div><!-- End Left side columns -->



            {{-- <!-- Details Modal-->
            <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Card with an image on left -->
                            <div class="col-md-4">
                                <img src="assets/img/card.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $barang->nama_brg }}</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a
                                        natural lead-in to additional content. This content is a little bit longer.
                                    </p>
                                </div>
                            </div><!-- End Card with an image on left -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- END Details Modal-->


            {{-- <!-- Tambah Barang Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Basic Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action ="/barang" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="mb-1">
                                        <label for="kode_brg" class="form-label">Kode Barang</label>
                                        <input type="text" class="form-control @error('kode_brg') is-invalid @enderror"
                                            id="kode_brg" name="kode_brg" value="{{ old('kode_brg') }}" autofocus>
                                        @error('kode_brg')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama_brg" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control @error('nama_brg') is-invalid @enderror"
                                            id="nama_brg" name="nama_brg" value="{{ old('nama_brg') }}" autofocus>
                                        @error('nama_brg')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <label for="harga_brg" class="form-label">Harga Barang</label>
                                        <input type="number" class="form-control @error('harga_brg') is-invalid @enderror"
                                            id="harga_brg" name="harga_brg" value="{{ old('harga_brg') }}" autofocus>
                                        @error('harga_brg')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <label for="stok_brg" class="form-label">Stok Barang</label>
                                        <input type="number" class="form-control @error('stok_brg') is-invalid @enderror"
                                            id="stok_brg" name="stok_brg" value="{{ old('stok_brg') }}" autofocus>
                                        @error('stok_brg')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <label for="kategori_brg" class="form-label">Foto Barang</label>
                                        <input type="file" class="form-control @error('foto_brg') is-invalid @enderror"
                                            id="foto_brg" name="foto_brg" value="{{ old('foto_brg') }}" autofocus>
                                        @error('foto_brg')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                      </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div><!-- End Tambah Barang Modal-->
 --}}


        </div>
    </section>

    <!-- The Modal -->
    <div id="modal_img" class="modal-image">
        <span class="close">&times;</span>
        <img class="modal-content-image" id="img01">
        <div id="caption"></div>
    </div>

    <script></script>
@endsection
