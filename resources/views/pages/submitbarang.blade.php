@extends('pages.component.template')

@section('konten')
    @pushOnce('scriptHeader')
        <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
        <style>
            th {
                white-space: nowrap;
            }
        </style>
    @endPushOnce
    <div class="page-heading">
        <h3>Data</h3>
    </div>
    <div class="page-content">
        <section class="row">
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
                                            <tr class="{{ ($index + 1) % 2 == 0 ? 'even' : 'odd' }} data">
                                                <td class="tbvalue">{{ $index + 1 }}</td>
                                                <td class="tbvalue">{{ $d->barcode }}</td>
                                                <td class="tbvalue">{{ $d->namabarang }}</td>
                                                <td class="tbvalue" id="hargajual{{ $d->id }}">{{ $d->hargajual }}
                                                </td>
                                                <td class="tbvalue">
                                                    {{ $d->jumlahbarang }}

                                                </td>

                                                <td class="tbvalue" id="hargatotal{{ $d->id }}">
                                                    {{ $d->hargajual * $d->jumlahbarang }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" style="text-align:right">Total:</th>

                                            <th>{{ $sumdata }}</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class=" col-md-4 ">
                    <div class="d-flex flex-row-reverse">
                        <div class="ml-auto card">

                            <div class="card-body py-4 px-4">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div>
                                            <form class="form form-horizontal" method="POST"
                                                action="{{ route('data.create') }}">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="total">Total</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" name="total" class="form-control"
                                                                data-parsley-required="true" id="total"
                                                                value="{{ $sumdata }}" style="text-align:right"
                                                                readonly>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="bayar">Bayar</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" name="bayar"
                                                                class="form-control @error('bayar') is-invalid @enderror"
                                                                data-parsley-required="true" id="bayar"
                                                                value="{{ old('bayar') }}" style="text-align:right">
                                                            @error('bayar')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="kembali">Kembali</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" name="kembali" class="form-control"
                                                                data-parsley-required="true" id="kembali" value=""
                                                                style="text-align:right" readonly>

                                                        </div>

                                                    </div>

                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <a type="button" href="{{ route('kasir.index') }}"
                                                            class="btn btn-danger me-1 mb-1">Batal</a>
                                                        <button type="submit"
                                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    @pushOnce('js')
        <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#bayar').on('change', function() {
                    console.log($(this).val());
                    $('#kembali').val($(this).val() - $('#total').val());
                })


            });
        </script>
        <script>
            // let jquery_datatable = $("#table1").DataTable();
            let jquery_datatable2 = $("#table2").DataTable({
                "scrollX": true,
                "autoWidth": false,
                "dom": 'Bfrtip',
                "bAutoWidth": false,
                "bPaginate": false,

            });
        </script>
    @endPushOnce
@endsection
