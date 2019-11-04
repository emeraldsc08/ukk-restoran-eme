@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Ubah Pesanan</h1>
    <p class="mb-4">Form untuk mengubah data pesanan</p>

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

    <form action="{{ url('/pesanan/update', $pesanan->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="">Nomer Meja</label>
            <select name="id_meja" id="" class="form-control">
                <option value="{{ $pesanan->meja->id }}">{{ $pesanan->meja->nomer }}</option>
                @foreach ($mejas as $meja)
                    @if ($meja->id != $pesanan->meja->id)
                        @if (!\App\Pesanan::where('id_meja', $meja->id)->where('status', 'Dalam proses')->exists())
                            <option value="{{ $meja->id }}">{{ $meja->nomer }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="Dalam proses" {{ $pesanan->status == "Dalam proses" ? "selected":"" }}>Dalam proses</option>
                <option value="Selesai" {{ $pesanan->status == "Selesai" ? "selected":"" }}>Selesai</option>
            </select>
        </div>
        <input type="submit" value="Ubah" class="btn btn-primary">
    </form>
@endsection