<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPesanan;
use App\Menu;
use App\Pesanan;

class DetailPesananController extends Controller
{
    /**
     * function untuk membuat detail pesanan baru
     */
    private function new(Request $request, $id_pesanan)
    {
        $menu = $this->pushMenu($request);
        $jumlah = $this->pushJumlah($request);
        $map = $this->mapOrder($menu, $jumlah);
        $order = $this->createAssocArr($map, $id_pesanan);

        return $order;
    }

    /**
     * function untuk push array menu
     */
    private function pushMenu(Request $request)
    {
        $menuArr = [];
        $menu = $request->input('id_menu');

        foreach ($menu as $item) {
            array_push($menuArr, $item);
        }

        return $menuArr;
    }

    /**
     * function untuk push array jumlah
     */
    private function pushJumlah(Request $request)
    {
        $jumlahArr = [];
        $jumlah = $request->input('jumlah');
        
        foreach ($jumlah as $item) {
            array_push($jumlahArr, $item);
        }

        return $jumlahArr;
    }

    /**
     * function untuk map array
     */
    private function mapOrder($menuArr, $jumlahArr)
    {
        return array_map(null, $menuArr, $jumlahArr);
    }

    /**
     * function untuk membuat array asosiatif
     */
    private function createAssocArr($arr, $id_pesanan)
    {
        $final = [];

        for ($i=0; $i < count($arr); $i++) { 
            if (!is_null($arr[$i][1]) && $arr[$i][1] != 0) {
                $final[] = [
                    'id_pesanan' => $id_pesanan,
                    'id_menu' => $arr[$i][0],
                    'jumlah' => $arr[$i][1],
                ];
            }
        }

        return $final;
    }

    /**
     * function untuk mass insert
     */
    private function store($order, $id_pesanan)
    {
        DetailPesanan::insert($order);
        $jml = count($order);

        return redirect()->route('detail.home', $id_pesanan)->with('detail_success', 'Berhasil menambah '. $jml .' item detail pesanan!');
    }

    /**
     * function untuk mengubah detail pesanan
     */
    private function edit(Request $request, $id)
    {
        $detail = DetailPesanan::where('id', $id)->first();
        $detail->id_menu = $request->input('id_menu');
        $detail->jumlah = $request->input('jumlah');
        $detail->status = $request->input('status');
        $detail->save();
    }

    /**
     * function untuk menghapus detail pesanan
     */
    private function delete(Request $request)
    {
        $detail = DetailPesanan::where('id', $request->input('id'))->first();
        $detail->delete();
    }

    /**
     * function untuk menampilkan detail pesanan dengan relasi detail_pesanan, dan meja
     */
    public function home($id_pesanan)
    {
        $detail_pesanans = Pesanan::where('id', $id_pesanan)->with('detail_pesanan', 'meja')->first();
        return view('detail.home', compact('detail_pesanans', 'id_pesanan'));
    }

    /**
     * function untuk menampilkan view penambahan detail pesanan baru
     */
    public function vNew($id_pesanan)
    {
        $menus = Menu::where('status', 'Tersedia')->get();
        return view('detail.new', compact('menus', 'id_pesanan'));
    }

    /**
     * function untuk menampilkan view pengubahan detail pesanan
     */
    public function vEdit($id_pesanan, $id)
    {
        $detail = DetailPesanan::where('id', $id)->with('menu')->first();
        $menus = Menu::where('status', 'Tersedia')->get();
        return view('detail.edit', compact('detail', 'menus', 'id_pesanan'));
    }

    /**
     * function untuk validasi input penambahan detail pesanan baru
     */
    public function validateNew(Request $request, $id_pesanan)
    {
        $order = $this->new($request,$id_pesanan);
        return $this->store($order, $id_pesanan);
    }

    /**
     * function untuk validasi input pengubahan detail pesanan baru
     */
    public function validateEdit(Request $request, $id_pesanan, $id)
    {
        $this->validate($request, [
            'id_menu' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'status' => 'required'
        ]);

        $this->edit($request, $id);
        return redirect()->route('detail.home', $id_pesanan)->with('detail_success', 'Berhasil mengubah data detail pesanan!');
    }

    /**
     * function untuk validasi input penghapusan detail pesanan baru
     */
    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $this->delete($request);
        return redirect()->back()->with('detail_success', 'Berhasil menghapus detail pesanan!');
    }

    /**
     * function untuk mengambil data detail pesanan dengan json
     */
    public function getWithJson($id)
    {
        $detail = DetailPesanan::where('id', $id)->with('menu')->first();
        return response()->json($detail);
    }
}
