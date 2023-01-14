@extends('pages.component.template')

@section('konten')
    @pushOnce('scriptHeader')
        <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    @endPushOnce
    <div class="page-heading">
        <h3>Data</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-3">
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
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Barang</h4>
                    </div>
                    <div class="card-body">

                        <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="table dataTable no-footer" id="table1" aria-describedby="table1_info">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Harga Awal</th>
                                        <th>Harga Jual</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $d)
                                        <tr class="{{ ($index + 1) % 2 == 0 ? 'even' : 'odd' }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $d->barcode }}</td>
                                            <td>{{ $d->namabarang }}</td>
                                            <td>{{ $d->jumlahbarang }}</td>
                                            <td>{{ $d->hargaawal }}</td>
                                            <td>{{ $d->hargajual }}</td>
                                            <td>
                                                <div class="align-item-center">
                                                    <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal" data-bs-target="#addData{{ $d->id }}"
                                                        data-bs-whatever="">Update</button>


                                                    <div class="modal fade" id="addData{{ $d->id }}" tabindex="-1"
                                                        aria-labelledby="addData{{ $d->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="addData{{ $d->id }}Label">Update Data
                                                                        {{ $d->namabarang }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST" action="{{ route('data.update') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $d->id }}">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="barcode"
                                                                                class="col-form-label">Barcode</label>
                                                                            <input type="text" name="barcode"
                                                                                class="form-control" id="barcode"
                                                                                value="{{ $d->barcode }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="namabarang"
                                                                                class="col-form-label">namabarang</label>
                                                                            <input type="text" name="namabarang"
                                                                                class="form-control" id="namabarang"
                                                                                value="{{ $d->namabarang }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jumlahbarang"
                                                                                class="col-form-label">Jumlah
                                                                                Barang</label>
                                                                            <input type="number" name="jumlahbarang"
                                                                                class="form-control" id="jumlahbarang"
                                                                                value="{{ $d->jumlahbarang }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="hargaawal"
                                                                                class="col-form-label">hargaawal</label>
                                                                            <input type="number" name="hargaawal"
                                                                                class="form-control" id="hargaawal"
                                                                                value="{{ $d->hargaawal }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="hargajual"
                                                                                class="col-form-label">hargajual</label>
                                                                            <input type="number" name="hargajual"
                                                                                class="form-control" id="hargajual"
                                                                                value="{{ $d->hargajual }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-outline-danger">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @pushOnce('js')
        <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    @endPushOnce
@endsection
