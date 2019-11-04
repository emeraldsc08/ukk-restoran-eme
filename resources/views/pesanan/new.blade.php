@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Pesanan</h1>
    <p class="mb-4">Form untuk menambahkan pesanan baru</p>

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

    <form action="{{ url('/pesanan/new', []) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Nomer Meja</label>
            <select name="id_meja" id="" class="form-control">
                <option value="">-- Pilih Meja --</option>
                @foreach ($mejas as $meja)
                    @if (!\App\Pesanan::where('id_meja', $meja->id)->where('status', 'Dalam proses')->exists())
                        <option value="{{ $meja->id }}">{{ $meja->nomer }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="submit" value="Lanjutkan" class="btn btn-primary">
    </form>
@endsection