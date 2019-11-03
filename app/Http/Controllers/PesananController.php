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
    public function new(Request $request)
    {
        $pesanan = new Pesanan();
        $pesanan->id_user = Session::get('userid');
        $pesanan->id_meja = $request->input('id_meja');
        $pesanan->save();

        return $pesanan->id;
    }

    public function edit(Request $request, $id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan->id_user = Session::get('userid');
        $pesanan->id_meja = $request->input('id_meja');
        $pesanan->save();
    }

    public function delete(Request $request)
    {
        $pesanan = Pesanan::where('id', $request->input('id'))->first();
        $pesanan->delete();
    }

    public function home()
    {
        $pesanans = Pesanan::with('user', 'detail_pesanan', 'meja')->get();
        return view('pesanan.home', compact('pesanans'));
    }

    public function vNew()
    {
        $mejas = Meja::all();
        return view('pesanan.new', compact('mejas'));
    }

    public function vEdit($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('meja')->first();
        $mejas = Meja::all();
        return view('pesanan.edit', compact('pesanan', 'mejas'));
    }

    public function getWithJson($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        return response()->json($pesanan, 200);
    }

    public function getTotal($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        $total = 0;

        foreach ($pesanan->detail_pesanan as $detail) {
            $total += $detail->menu->harga * $detail->jumlah;
        }
        
        return response()->json($total);
    }

    public function validateNew(Request $request)
    {
        $this->validate($request, [
            'id_meja' => 'required|numeric'
        ]);

        $id_pesanan = $this->new($request);
        return redirect()->route('detail.home', $id_pesanan);
    }

    public function validateEdit(Request $request, $id)
    {
        $this->validate($request, [
            'id_meja' => 'required|numeric'
        ]);

        $this->edit($request, $id);
        return redirect('/pesanan/home')->with('pesanan_success', 'Berhasil mengubah data pesanan!');
    }

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric'
        ]);

        $this->delete($request);
        return redirect('/pesanan/home')->with('pesanan_success', 'Berhasil menghapus pesanan!');
    }

    public function exportToExcel()
    {
        return Excel::download(new PesananExport, 'pesanan.xlsx');
    }
}
