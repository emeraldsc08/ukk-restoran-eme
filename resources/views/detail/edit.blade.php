@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Ubah Data Detail Pesanan</h1>
    <p class="mb-4">Form untuk mengubah data detail pemesanan</p>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif

    <form action="{{ route('detail.edit', ['id_pesanan' => $id_pesanan, 'id' => $detail->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="">Nama Menu</label>
            <select id="" class="form-control" name="id_menu">
                <option value="{{ $detail->menu->id }}">{{ $detail->menu->nama }}</option>
                @foreach ($menus as $menu)
                    @if ($menu->id != $detail->menu->id)
                        <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Jumlah</label>
            <input type="number" id="" value="{{ $detail->jumlah }}" class="form-control" name="jumlah">
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="Dipesan" {{ $detail->status == "Dipesan" ? "selected":"" }}>Dipesan</option>
                <option value="Dibuat" {{ $detail->status == "Dibuat" ? "selected":"" }}>Dibuat</option>
                <option value="Sudah diantar" {{ $detail->status == "Sudah diantar" ? "selected":"" }}>Sudah diantar</option>
            </select>
        </div>
        <input type="submit" value="Ubah" class="btn btn-primary">
    </form>
@endsection