@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Pesanan</h1>
    <p class="mb-2">Berisi data-data pesanan</p>
    <a href="{{ url('/pesanan/download-report') }}" class="btn btn-info mb-4">Export</a>

    @if (Session::has('pesanan_success'))
        <div class="alert alert-success mb-4" role="alert">
            <strong>{{ Session::get('pesanan_success') }}</strong>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                            <th>Nomer Meja</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($pesanans as $pesanan)
                            @foreach ($pesanan->detail_pesanan as $detail)
                                @php
                                    $total += $detail->menu->harga * $detail->jumlah
                                @endphp
                            @endforeach
                            <tr>
                                <td>{{ $pesanan->user->username }}</td>
                                <td>{{ $pesanan->meja->nomer }}</td>
                                <td>{{ $total }}</td>
                                <td>
                                    @if (!\App\Transaksi::where('id_pesanan', $pesanan->id)->exists())
                                        <a href="{{ url('/pesanan/update', $pesanan->id) }}" class="btn btn-default">Ubah</a>
                                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modelId" onclick="prepare({{ $pesanan->id }})">Hapus</a>
                                    @else
                                        <a href="" class="btn btn-info disabled">Ubah</a>
                                        <a href="" class="btn btn-danger disabled">Hapus</a>
                                    @endif
                                    <a href="{{ route('detail.home', $pesanan->id) }}" class="btn btn-info">Detail</a>
                                </td>
                            </tr>
                            @php
                                $total = 0;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ url('/pelanggan/delete', []) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" id="pelangganid" readonly>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data pelanggan: <b><span id="namapelanggan"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <input type="submit" value="Hapus" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function prepare(pelangganId) {
            var idPelanggan = pelangganId
            var siteUrl = "{{ url('/pelanggan/json', 'id') }}"
            siteUrl = siteUrl.replace('id', idPelanggan)

            $.getJSON(siteUrl, function (data) {
                $('#pelangganid').val(data.id)
                $('#namapelanggan').text(data.nama)
            })
        }
    </script>
@endsection