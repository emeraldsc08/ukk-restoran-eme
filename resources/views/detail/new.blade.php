@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Detail Pesanan</h1>
    <p class="mb-4">Form untuk menambahkan detail pemesanan</p>

    {{-- @if ($errors->any())
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

    <form action="{{ route('detail.new', $id_pesanan) }}" method="post" class="mb-3">
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
    
    @if (Session::has('detail'))
        <form action="{{ route('detail.store', $id_pesanan) }}" method="post">
            {{ csrf_field() }}
            <input type="submit" value="Simpan {{ '('. count(Session::get('detail')) .')' }}" class="btn btn-success">
        </form>
    @endif --}}

    <div class="row">
        <div class="col-md-6">
            <h4>Menu</h4>
        </div>
        <div class="col-md-6">
            <h4>Jumlah</h4>
        </div>
    </div>
    <hr>
    <form action="{{ route('detail.new', $id_pesanan) }}" class="mb-4" method="post">
        {{ csrf_field() }}
        @foreach ($menus as $item)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ $item->nama }}</label>
                        <input type="hidden" name="id_menu[]" value="{{ $item->id }}" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="number" name="jumlah[]" id="" min="0" class="form-control">
                </div>
            </div>
        @endforeach
        <input type="submit" value="Pesan" class="btn btn-success">
    </form>
@endsection