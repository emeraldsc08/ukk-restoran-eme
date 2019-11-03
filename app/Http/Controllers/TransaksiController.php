<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Pesanan;
use Illuminate\Http\Request;
use App\Transaksi;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    private function bayar(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->id_pesanan = $request->input('id_pesanan');
        $transaksi->bayar = $request->input('bayar');
        $transaksi->save();
    }

    private function total($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        $total = 0;

        foreach ($pesanan->detail_pesanan as $detail) {
            $total += $detail->menu->harga * $detail->jumlah;
        }

        return $total;
    }

    public function home()
    {
        $transaksis = Transaksi::with('pesanan')->get();
        return view('transaksi.home', compact('transaksis'));
    }

    public function vBayar()
    {
        $pesanans = Pesanan::with('meja')->get();
        return view('transaksi.new', compact('pesanans'));
    }

    public function validateBayar(Request $request)
    {
        $this->validate($request,[
            'id_pesanan' => 'required|numeric',
            'bayar' => 'required|numeric'
        ]);

        $total = $this->total($request->input('id_pesanan'));
        if ($request->input('bayar') < $total) {
            return redirect()->back()->with('transaksi_err', 'Pembayaran tidak cukup!');
        }

        else {
            $this->bayar($request);
            return redirect('/transaksi/home')->with('transaksi_success', 'Pembayaran berhasil!');
        }
    }

    public function exportToExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
