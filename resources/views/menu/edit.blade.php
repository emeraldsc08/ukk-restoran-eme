@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Ubah Menu</h1>
    <p class="mb-4">Form untuk mengubah menu-menu</p>

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

    <form action="{{ url('/menu/update', $menu->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="">Nama Menu</label>
            <input type="text" name="nama" id="" class="form-control" value="{{ $menu->nama }}" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="">Harga Menu</label>
            <input type="number" name="harga" id="" class="form-control" value="{{ $menu->harga }}" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="">Jenis Menu</label>
            <select name="jenis_menu" id="" class="form-control">
                <option value="{{ $menu->id_jenis_menu }}">{{ $menu->jenisMenu->nama }}</option>
                @foreach ($jenis_menus as $jenis)
                    @if ($jenis->id != $menu->id_jenis_menu)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="Tersedia" {{ $menu->status == "Tersedia" ? "selected":"" }}>Tersedia</option>
                <option value="Tidak tersedia" {{ $menu->status == "Tidak tersedia" ? "selected":"" }}>Tidak tersedia</option>
            </select>
        </div>
        <input type="submit" value="Ubah" class="btn btn-primary">
    </form>
@endsection