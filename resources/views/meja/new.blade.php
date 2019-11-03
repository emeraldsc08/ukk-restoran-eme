@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Meja</h1>
    <p class="mb-4">Form untuk menambahkan meja-meja baru</p>

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

    <form action="{{ url('/meja/new', []) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Nomer</label>
            <input type="number" name="nomer" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <input type="submit" value="Tambahkan" class="btn btn-primary">
    </form>
@endsection
