@extends('admins.layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Barang Form</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" action="/barang/{{ $data->id }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="kode_brg" class="form-control @error('kode_brg') is-invalid @enderror"
                            id="kode_brg" placeholder="Kode Barang"value="{{old('kode_brg',$data->kode_brg)}}" autofocus>
                        @error('kode_brg')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="kode_brg">Kode Barang</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="nama_brg" class="form-control @error('nama_brg') is-invalid @enderror""
                            id="nama_brg" placeholder="Nama Barang" value="{{ old('nama_brg',$data->nama_brg) }}" autofocus>
                        @error('nama_brg')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="nama_brg">Nama Barang</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="number" name="stok_brg" class="form-control @error('stok_brg') is-invalid @enderror" value="{{ old('stok_brg', $data->stok_brg) }}" id="stok_brg" placeholder="Kode Barang">
                        @error('stok_brg')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="stok_brg">Stok Barang</label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-floating">
                        <input type="number" name="harga_brg" class="form-control @error('harga_brg') is-invalid @enderror" id="harga_brg" value="{{ old('harga_brg',$data->harga_brg) }}" autofocus placeholder="Harga Barang">
                        @error('harga_brg')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="harga_brg">Harga Barang</label>
                    </div>
                </div>

                <div class="mb-1">
                    @if ($data->foto_brg)
                        <img style="max-width: 250px" src="{{ url('images').'/'.$data->foto_brg }}" alt="{{ $data->nama_brg }}"
                            class="img-thumbnail img-preview">
                    @endif
                </div>


                <div class="mb-1">
                    <label for="kategori_brg" class="form-label">Foto Barang</label>
                    <input type="file" class="form-control @error('foto_brg') is-invalid @enderror" id="foto_brg"
                        name="foto_brg" value="{{ old('foto_brg') }}" autofocus>
                    @error('foto_brg')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary m-2">Save</button>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>
    <br>
@endsection
