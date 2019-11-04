<?php

namespace App\Http\Controllers;

use App\Exports\PesananExport;
use Illuminate\Http\Request;
use App\Meja;
use App\Pesanan;
use \Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PesananController extends Controller
{
    /**
     * function untuk menambahkan record pesanan dan return id
     */
    public function new(Request $request)
    {
        $pesanan = new Pesanan();
        $pesanan->id_user = Session::get('userid');
        $pesanan->id_meja = $request->input('id_meja');
        $pesanan->save();

        return $pesanan->id;
    }

    /**
     * function untuk mengubah record pesanan
     */
    public function edit(Request $request, $id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan->id_user = Session::get('userid');
        $pesanan->id_meja = $request->input('id_meja');
        $pesanan->status = $request->input('status');
        $pesanan->save();
    }

    /**
     * function untuk menghapus record pesanan
     */
    public function delete(Request $request)
    {
        $pesanan = Pesanan::where('id', $request->input('id'))->first();
        $pesanan->delete();
    }

    /**
     * function untuk menampilkan semua data pesanan
     * dan join ke user, detail_pesanan, dan meja
     */
    public function home()
    {
        $pesanans = Pesanan::with('user', 'detail_pesanan', 'meja')->get();
        return view('pesanan.home', compact('pesanans'));
    }

    /**
     * function untuk menampilkan view penambahan pesanan
     */
    public function vNew()
    {
        $mejas = Meja::all();
        return view('pesanan.new', compact('mejas'));
    }

    /**
     * function untuk menampilkan view pengubahan pesanan
     */
    public function vEdit($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('meja')->first();
        $mejas = Meja::all();
        return view('pesanan.edit', compact('pesanan', 'mejas'));
    }

    /**
     * function untuk me-return data pesanan dengan json
     */
    public function getWithJson($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        return response()->json($pesanan, 200);
    }

    /**
     * function untuk mendapatkan total harga pada pesanan
     */
    public function getTotal($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        $total = 0;

        foreach ($pesanan->detail_pesanan as $detail) {
            $total += $detail->menu->harga * $detail->jumlah;
        }
        
        return response()->json($total);
    }

    /**
     * function untuk validasi input penambahan pesanan
     */
    public function validateNew(Request $request)
    {
        $this->validate($request, [
            'id_meja' => 'required|numeric'
        ]);

        $id_pesanan = $this->new($request);
        return redirect()->route('detail.home', $id_pesanan);
    }

    /**
     * function untuk validasi input pengubahan pesanan
     */
    public function validateEdit(Request $request, $id)
    {
        $this->validate($request, [
            'id_meja' => 'required|numeric',
            'status' => 'required'
        ]);

        $this->edit($request, $id);
        return redirect('/pesanan/home')->with('pesanan_success', 'Berhasil mengubah data pesanan!');
    }

    /**
     * function untuk validasi input penghapusan pesanan
     */
    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric'
        ]);

        $this->delete($request);
        return redirect('/pesanan/home')->with('pesanan_success', 'Berhasil menghapus pesanan!');
    }

    /**
     * function untuk export to excel
     */
    public function exportToExcel()
    {
        return Excel::download(new PesananExport, 'pesanan.xlsx');
    }
}
