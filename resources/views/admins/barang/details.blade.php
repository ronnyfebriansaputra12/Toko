@extends('admins.layouts.main')

@section('container')

        
        <div class="pagetitle">
            <h1>Detail Barang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/barang">Barang</a></li>
                    <li class="breadcrumb-item active">Detail Barang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

          <!-- Card with an image on left -->
          {{-- <div class="card mb-3" style="margin-top: 100px; margin-bottom: 400px">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ url('images').'/'.$barang->foto_brg }}" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $barang->nama_brg }}</h5>
                  <h6 class="card-text">{{ $barang->kode_brg }}</h6>
                  <h6 class="card-text">{{'Rp'.'.'. $barang->harga_brg }}</h6>
                  <h6 class="card-text">{{'Stok : '.$barang->stok_brg }}</h6>
                </div>
              </div>
            </div>
          </div> --}}
          <!-- End Card with an image on left -->

                    <!-- Card with an image on top -->
                    <div class="col-md-6 mt-4">
                    <div class="card">
                        <img style="max-width: 500px" src="{{ url('images').'/'.$barang->foto_brg }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $barang->nama_brg }}</h5>
                            <h6 class="card-text">{{ $barang->kode_brg }}</h6>
                            <h6 class="card-text">{{'Rp'.'.'. $barang->harga_brg }}</h6>
                            <h6 class="card-text">{{'Stok : '.$barang->stok_brg }}</h6>
                        </div>
                      </div><!-- End Card with an image on top -->
                    </div>

@endsection