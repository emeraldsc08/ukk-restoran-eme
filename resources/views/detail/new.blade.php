@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Detail Pesanan</h1>
    <p class="mb-4">Form untuk menambahkan detail pemesanan</p>

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

    <form action="{{ route('detail.new', $id_pesanan) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Nama Menu</label>
            <select id="" class="form-control" name="id_menu">
                <option value="">-- Pilih menu --</option>
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Jumlah</label>
            <input type="number" id="" class="form-control" name="jumlah">
        </div>
        <input type="submit" value="Tambahkan" class="btn btn-primary">
    </form>
@endsection