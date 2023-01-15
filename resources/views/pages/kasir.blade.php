@extends('pages.component.template')


@section('konten')
    @pushOnce('scriptHeader')
        <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    @endPushOnce
    <div class="page-heading">
        <h3>Kasir</h3>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
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
                                        <th>Harga</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $a)
                                        <tr class="{{ ($index + 1) % 2 == 0 ? 'even' : 'odd' }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $a->barcode }}</td>
                                            <td>{{ $a->namabarang }}</td>
                                            <td>{{ $a->jumlahbarang }}</td>

                                            <td>{{ $a->hargajual }}</td>
                                            <td>
                                                <form action="{{ route('kasir.create') }}" method="post">
                                                    <input type="hidden" name="id" value="{{ $a->id }}">
                                                    @csrf
                                                    <button class="btn btn-outline-info AddData" type="submit">Add</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Keranjang</h4>
                    </div>
                    <div class="card-body">
                        <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="table dataTable no-footer" id="table2" aria-describedby="table1_info">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>

                                        <th>Harga</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datakeranjang as $index => $d)
                                        <tr class="{{ ($index + 1) % 2 == 0 ? 'even' : 'odd' }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $d->barcode }}</td>
                                            <td>{{ $d->namabarang }}</td>
                                            <td id="hargajual{{ $d->id }}">{{ $d->hargajual }}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <div class="d-inline-flex">
                                                        <button class="btn btn-outline-danger kurang"
                                                            data-bs-id="{{ $d->id }}" type="button">-</button>
                                                    </div>
                                                    <div class="d-inline-flex">
                                                        <input type="text" class="btn btn-outline-dark jumlahbarang"
                                                            value="{{ $d->jumlahbarang }}"
                                                            id="valuejumlahbarang{{ $d->id }}"
                                                            data-bs-id="{{ $d->id }}">
                                                    </div>
                                                    <button class="btn btn-outline-info tambah"
                                                        data-bs-id="{{ $d->id }}" type="button">+</button>
                                                </div>
                                            </td>

                                            <td id="hargatotal{{ $d->id }}">{{ $d->hargajual * $d->jumlahbarang }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushOnce('js')
        <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                function updatedb(id, data) {
                    $.ajax({
                        type: 'PUT',
                        data: {
                            'id': id,
                            'data': data
                        },
                        url: "{{ route('kasir.edit') }}",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            // console.log(data.data);
                            mydata = data.data;
                        }
                    });

                }

                $('.jumlahbarang').on('change', function(e) {
                    e.preventDefault();
                    var iddatabs = $(this).attr("data-bs-id");
                    var valuedatabs1 = this.value;
                    $.ajax({
                        type: 'PUT',
                        data: {
                            'id': iddatabs,
                            'data': valuedatabs1
                        },
                        url: "{{ route('kasir.edit') }}",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            // console.log(data.data);
                            var datahargajual = parseInt($('#hargajual' + iddatabs).html());
                            $('#hargatotal' + iddatabs).html(datahargajual * data.data);
                            $('#valuejumlahbarang' + iddatabs).val(data.data);
                            if (data.data == 0) {
                                confirm('anda akan menghapus?');
                                // window.location.reload();
                            }
                        }
                    });







                });





                $('.kurang').on('click', function(e) {
                    e.preventDefault()
                    var attrkurang = $(this).attr("data-bs-id");
                    var data = parseInt($('#valuejumlahbarang' + attrkurang).val());



                    $('#valuejumlahbarang' + attrkurang).val(data -= 1);
                    var datahargajual = parseInt($('#hargajual' + attrkurang).html());
                    $('#hargatotal' + attrkurang).html(datahargajual * data);

                    if (data == 0) {
                        if (confirm('anda akan menghapus?') == true) {
                            window.location.reload();

                        } else {

                            $('#valuejumlahbarang' + attrkurang).val(data = 1);
                            var datahargajual = parseInt($('#hargajual' + attrkurang).html());
                            $('#hargatotal' + attrkurang).html(datahargajual * data);
                            updatedb(attrkurang, data);
                        }

                    }
                });

                $('.tambah').on('click', function(e) {
                    e.preventDefault()
                    var attrtambah = $(this).attr("data-bs-id");
                    var data = parseInt($('#valuejumlahbarang' + attrtambah).val());

                    $('#valuejumlahbarang' + attrtambah).val(data += 1);
                    var datahargajual = parseInt($('#hargajual' + attrtambah).html());
                    $('#hargatotal' + attrtambah).html(datahargajual * data);
                    updatedb(attrtambah, data);

                });


            });
        </script>
    @endPushOnce
@endsection
