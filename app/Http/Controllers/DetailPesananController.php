<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPesanan;
use App\Menu;
use App\Pesanan;

class DetailPesananController extends Controller
{
    public function new(Request $request, $id_pesanan)
    {
        $detail = new DetailPesanan();
        $detail->id_pesanan = $id_pesanan;
        $detail->id_menu = $request->input('id_menu');
        $detail->jumlah = $request->input('jumlah');
        $detail->save();
    }

    public function edit(Request $request, $id)
    {
        $detail = DetailPesanan::where('id', $id)->first();
        $detail->id_menu = $request->input('id_menu');
        $detail->jumlah = $request->input('jumlah');
        $detail->status = $request->input('status');
        $detail->save();
    }

    public function delete(Request $request)
    {
        $detail = DetailPesanan::where('id', $request->input('id'))->first();
        $detail->delete();
    }

    public function home($id_pesanan)
    {
        $detail_pesanans = Pesanan::where('id', $id_pesanan)->with('detail_pesanan', 'meja')->first();
        return view('detail.home', compact('detail_pesanans', 'id_pesanan'));
    }

    public function vNew($id_pesanan)
    {
        $menus = Menu::where('status', 'Tersedia')->get();
        return view('detail.new', compact('menus', 'id_pesanan'));
    }

    public function vEdit($id_pesanan, $id)
    {
        $detail = DetailPesanan::where('id', $id)->with('menu')->first();
        $menus = Menu::where('status', 'Tersedia')->get();
        return view('detail.edit', compact('detail', 'menus', 'id_pesanan'));
    }

    public function validateNew(Request $request, $id_pesanan)
    {
        $this->validate($request, [
            'id_menu' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        $this->new($request, $id_pesanan);
        return redirect()->route('detail.home', $id_pesanan)->with('detail_success', 'Berhasil menambah detail pesanan!');
    }

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

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $this->delete($request);
        return redirect()->back()->with('detail_success', 'Berhasil menghapus detail pesanan!');
    }

    public function getWithJson($id)
    {
        $detail = DetailPesanan::where('id', $id)->with('menu')->first();
        return response()->json($detail);
    }
}
