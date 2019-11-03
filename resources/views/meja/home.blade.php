@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Meja</h1>
    <p class="mb-4">Berisi daftar meja di restoran</p>

    @if (Session::has('meja_success'))
        <div class="alert alert-success mb-4" role="alert">
            <strong>{{ Session::get('meja_success') }}</strong>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Meja</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mejas as $meja)
                            <tr>
                                <td>{{ $meja->nomer }}</td>
                                <td>
                                    <a href="{{ url('/meja/update', $meja->id) }}" class="btn btn-default">Ubah</a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modelId" onclick="prepare({{ $meja->id }})">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Meja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ url('/meja/delete', []) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" id="mejaid" readonly>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus meja nomer: <b><span id="nomer"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
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
        function prepare(mejaId) {
            var idMeja = mejaId
            var siteUrl = "{{ url('/meja/json', 'id') }}"
            siteUrl = siteUrl.replace('id', idMeja)

            $.getJSON(siteUrl, function (data) {
                $('#mejaid').val(data.id)
                $('#nomer').text(data.nomer)
            })
        }
    </script>
@endsection