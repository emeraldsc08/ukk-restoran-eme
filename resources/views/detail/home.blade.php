@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Detail Pesanan</h1>
    <p class="mb-2">Berisi menu-menu yang dipesan meja nomer <b>{{ $detail_pesanans->meja->nomer }}</b> di tanggal <b>{{ $detail_pesanans->created_at }}</b></p>
    @if (\App\Transaksi::where('id_pesanan', $detail_pesanans->id)->exists())
        <a href="" class="btn btn-success mb-4 disabled">Tambah</a>
    @else
        <a href="{{ route('detail.vnew', $detail_pesanans->id) }}" class="btn btn-success mb-4">Tambah</a>
    @endif

    @if (Session::has('detail_success'))
        <div class="alert alert-success mb-4" role="alert">
            <strong>{{ Session::get('detail_success') }}</strong>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Detail Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama menu</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($detail_pesanans->detail_pesanan as $detail)
                            <tr>
                                <td>{{ $detail->menu->nama }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>{{ $detail->menu->harga * $detail->jumlah }}</td>
                                <td>{{ $detail->status }}</td>
                                <td>
                                    @if (\App\Transaksi::where('id_pesanan', $detail_pesanans->id)->exists())
                                        <a href="" class="btn btn-default disabled">Ubah</a>
                                        <a href="" class="btn btn-danger disabled">Hapus</a>
                                    @else
                                        <a href="{{ route('detail.vedit', [$detail_pesanans->id, $detail->id]) }}" class="btn btn-default">Ubah</a>
                                        <a href="" data-target="#modelId" data-toggle="modal" onclick="prepare({{ $detail->id }})" class="btn btn-danger">Hapus</a>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $total += $detail->menu->harga * $detail->jumlah
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>{{ $total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ url('pesanan/detail/delete', []) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="text" name="id" id="detailid" readonly>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus pemesanan <b><span id="nama"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
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
        function prepare(detailId) {
            var siteUrl = "{{ url('/pesanan/detail/json', 'id') }}"
            siteUrl = siteUrl.replace('id', detailId)

            $.getJSON(siteUrl, function (data) {
                $('#detailid').val(data.id)
                $('#nama').text(data.menu.nama)
            })
        }
    </script>
@endsection