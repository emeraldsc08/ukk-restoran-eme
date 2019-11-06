@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>
    <p class="mb-4">Form untuk menambahkan transaksi baru</p>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(Session::has('transaksi_err'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ Session::get('transaksi_err') }}</strong>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif
    
    <form action="{{ url('/transaksi/bayar', []) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Nomer Pesanan</label>
            <select name="id_pesanan" id="pesanan" class="form-control" onchange="prepare()">
                <option value="">-- Pilih Nomer Pesanan --</option>
                @foreach ($pesanans as $pesanan)
                    @if ($pesanan->status != 'Dalam proses')
                        @if (!\App\Transaksi::where('id_pesanan', $pesanan->id)->exists())
                            <option value="{{ $pesanan->id }}">Nomer : {{ $pesanan->id }}, Meja : {{ $pesanan->meja->nomer }}, Waktu : {{ $pesanan->created_at }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Total</label>
            <input type="text" name="total" id="total" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="">Bayar</label>
            <input type="number" name="bayar" class="form-control">
        </div>
        <input type="submit" value="Bayar" class="btn btn-primary">
    </form>

    <script>
        function prepare() {
            var idPesanan = $('#pesanan').val()
            var siteUrl = "{{ url('/pesanan/total', 'id') }}"
            siteUrl = siteUrl.replace('id', idPesanan)

            $.getJSON(siteUrl, function (data) {
                $('#total').val(data)
            })
        }
    </script>
@endsection