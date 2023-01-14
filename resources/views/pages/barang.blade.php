@extends('pages.component.template')

@section('konten')
    <div class="page-heading">
        <h3>Data</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data</h4>
                    </div>

                    <div class="card-body py-4 px-4">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="d-flex align-items-center">
                            <div>
                                <div>
                                    <form class="form form-horizontal" method="POST" action="{{ route('data.create') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="barcode">Barcode</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="barcode"
                                                        class="form-control @error('barcode') is-invalid @enderror"
                                                        data-parsley-required="true" id="barcode"
                                                        value="{{ old('barcode') }}">
                                                    @error('barcode')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="namabarang">Nama Barang</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="namabarang"
                                                        class="form-control @error('namabarang') is-invalid @enderror"
                                                        data-parsley-required="true" id="namabarang"
                                                        value="{{ old('namabarang') }}">
                                                    @error('namabarang')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="jumlahbarang">Jumlah Barang</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="jumlahbarang"
                                                        class="form-control @error('jumlahbarang') is-invalid @enderror"
                                                        data-parsley-required="true" id="jumlahbarang"
                                                        value="{{ old('jumlahbarang') }}">
                                                    @error('jumlahbarang')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="hargaawal">Harga Awal</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="hargaawal"
                                                        class="form-control @error('hargaawal') is-invalid @enderror"
                                                        data-parsley-required="true" id="hargaawal"
                                                        value="{{ old('hargaawal') }}">
                                                    @error('hargaawal')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="hargajual">Harga Jual</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" name="hargajual"
                                                        class="form-control @error('hargajual') is-invalid @enderror"
                                                        data-parsley-required="true" id="hargajual"
                                                        value="{{ old('hargajual') }}">
                                                    @error('hargajual')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Barang</h4>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @pushOnce('js')
        <script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/parsley.js') }}"></script>
    @endPushOnce
@endsection
