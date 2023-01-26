<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            font-size: 18px;
            font-family: Times New Roman;
        }

        body {
            background-color: #f8f8f8;
        }

        .margin {
            background-color: #fff;
            width: 80%;
            margin: 20px auto;
            box-shadow: 0 1px 1px 0 #ccc;
            padding: 40px 60px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td:first-child {
            width: 30%;
        }

        td {
            padding: 10px;
        }

        h4 {
            font-size: 25px;
        }

        h1 {
            font-size: 30px;
        }

        .headertable {

            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="margin">
        <h1 align="center">Nota Transaksi Pembelian</h1>
        <hr>
        <br>
        <table border="1">
            <tr>
                <td>Nomer Nota</td>
                <td>: {{ $nomernota->nomernota - 1 }}</td>

            </tr>
        </table>
        <h4>Data Order Transaksi Tiket</h4>
        <table border="1">
            <tr>
                <td class="headertable">No</td>
                <td class="headertable">Nama Barang</td>
                <td class="headertable">Jumlah Barang</td>
                <td class="headertable">Harga Barang</td>
                <td class="headertable">Total</td>
            </tr>

            @foreach ($datakasir as $key => $d)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $d->namabarang }}</td>
                    <td>{{ $d->jumlahbarang }}</td>
                    <td>{{ $d->hargajual }}</td>
                    <td>{{ $d->jumlahbarang * $d->hargajual }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td class="headertable" style="text-align:center">Jumlah</td>
                <td style="font-weight:bold">{{ $total }}</td>
            </tr>
        </table>
        <br>
        <h4>Keterangan :</h4>
        <p>Proses pembayaran sewa dilakukan dengan cara transef Bank ke No Rek BCA : 1232123 (Ticketmonstr).<br> Batas
            waktu transfer 3 hari dari Tanggal Order Transaksi. Jika melewati batas yang sudah ditentukan, maka proses
            transaksi yang dilakukan akan dihapus oleh admin</p>
        <br>
        <p align="right">Denpasar, 12 October 2016<br>Manager Pemasaran<br><br><br><br>Admin</p>
    </div>
    <script>
        setTimeout(() => {
            // location.reload();
        }, 10000);
    </script>
</body>

</html>
