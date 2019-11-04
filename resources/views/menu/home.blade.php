@extends('base')
@section('site-content')
    <h1 class="h3 mb-2 text-gray-800">Menu</h1>
    <p class="mb-4">Berisi menu-menu yang dijual dan detail harganya</p>

    @if (Session::has('menu_success'))
        <div class="alert alert-success mb-4" role="alert">
            <strong>{{ Session::get('menu_success') }}</strong>
        </div>
    @endif

    @if (Session::has('access_err'))
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ Session::get('access_err') }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama menu</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->nama }}</td>
                                <td>{{ $menu->harga }}</td>
                                <td>{{ $menu->jenisMenu->nama }}</td>
                                <td>{{ $menu->status }}</td>
                                <td>
                                    <a href="{{ url('/menu/update', $menu->id) }}" class="btn btn-default">Ubah</a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modelId" onclick="prepare({{ $menu->id }})">Hapus</a>
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
                    <h5 class="modal-title">Konfirmasi Hapus Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="{{ url('/menu/delete', []) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id" id="menuid" readonly>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus <b><span id="jenis"></span></b>: <b><span id="nama"></span></b>? Aksi ini tidak dapat di-<i>undo</i>
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
        function prepare(menuId) {
            var idMenu = menuId
            var siteUrl = "{{ url('/menu/json', 'id') }}"
            siteUrl = siteUrl.replace('id', idMenu)

            $.getJSON(siteUrl, function (data) {
                $('#menuid').val(data.id)
                $('#jenis').text(data.jenis_menu.nama)
                $('#nama').text(data.nama)
            })
        }
    </script>
@endsection