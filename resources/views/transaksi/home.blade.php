@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>
    <p class="mb-2">Berisi data-data transaksi</p>
    <a href="{{ url('/transaksi/download-report') }}" class="btn btn-info mb-4">Export</a>

    @if (Session::has('transaksi_success'))
        <div class="alert alert-success mb-4" role="alert">
            <strong>{{ Session::get('transaksi_success') }}</strong>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomer Pesanan</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembali</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($transaksis as $transaksi)
                            @foreach ($transaksi->pesanan->detail_pesanan as $detail)
                                @php
                                    $total += $detail->menu->harga * $detail->jumlah
                                @endphp
                            @endforeach
                            <tr>
                                <td>{{ $transaksi->id_pesanan }}</td>
                                <td>{{ $total }}</td>
                                <td>{{ $transaksi->bayar }}</td>
                                <td>{{ $transaksi->bayar - $total }}</td>
                                <td>{{ $transaksi->created_at }}</td>
                                <td>
                                    <a href="{{ route('transaksi.invo', $transaksi->id) }}" target="_blank" class="btn btn-info">Nota</a>
                                </td>
                            </tr>
                            @php
                                $total = 0
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection