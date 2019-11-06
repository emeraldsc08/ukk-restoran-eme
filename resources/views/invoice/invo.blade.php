<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota meja {{ $transaksi->pesanan->meja->nomer }} | {{ $transaksi->created_at }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ url('public/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        #container {
            width: 700px;
            height: fit-content;
            margin: 0 auto;
        }

        .td-title {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="container">
        <h3 class="text-center mb-2 mt-4">Nota Pembayaran</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Invoice #{{ $transaksi->id }}</th>
                    <th>Meja {{ $transaksi->pesanan->meja->nomer }}</th>
                    <th>{{ $transaksi->created_at }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-title">Nama Menu</td>
                    <td class="td-title">Harga</td>
                    <td class="td-title">Jumlah</td>
                    <td class="td-title">Subtotal</td>
                </tr>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaksi->pesanan->detail_pesanan as $detail)
                    <tr>
                        <td>{{ $detail->menu->nama }}</td>
                        <td>{{ $detail->menu->harga }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->menu->harga * $detail->jumlah }}</td>
                    </tr>
                    @php
                        $total += $detail->menu->harga * $detail->jumlah
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="td-title">Total</td>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="td-title">Bayar</td>
                    <td>{{ $transaksi->bayar }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="td-title">Kembali</td>
                    <td>{{ $transaksi->bayar - $total }}</td>
                </tr>
            </tfoot>
        </table>
    </div> 
</body>
</html>