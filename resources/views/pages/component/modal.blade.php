<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addData" data-bs-whatever="">Tambah
    Data</button>


<div class="modal fade" id="addData" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('data.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="barcode" class="col-form-label">Barcode</label>
                        <input type="text" name="barcode" class="form-control" id="barcode">
                    </div>
                    <div class="mb-3">
                        <label for="namabarang" class="col-form-label">namabarang</label>
                        <input type="text" name="namabarang" class="form-control" id="namabarang">
                    </div>
                    <div class="mb-3">
                        <label for="jumlahbarang" class="col-form-label">Jumlah
                            Barang</label>
                        <input type="number" name="jumlahbarang" class="form-control" id="jumlahbarang">
                    </div>
                    <div class="mb-3">
                        <label for="hargaawal" class="col-form-label">hargaawal</label>
                        <input type="number" name="hargaawal" class="form-control" id="hargaawal">
                    </div>
                    <div class="mb-3">
                        <label for="hargajual" class="col-form-label">hargajual</label>
                        <input type="number" name="hargajual" class="form-control" id="hargajual">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
