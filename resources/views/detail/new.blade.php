@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Detail Pesanan</h1>
    <p class="mb-4">Form untuk menambahkan detail pemesanan</p>
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