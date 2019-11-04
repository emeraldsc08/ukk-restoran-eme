<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Pesanan;
use Illuminate\Http\Request;
use App\Transaksi;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
     /**
     * function untuk melakukan pembayaran
     */
    private function bayar(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->id_pesanan = $request->input('id_pesanan');
        $transaksi->bayar = $request->input('bayar');
        $transaksi->save();
    }

     /**
     * function untuk menghitung total biaya yang harus dibayarkan
     */
    private function total($id)
    {
        $pesanan = Pesanan::where('id', $id)->with('detail_pesanan')->first();
        $total = 0;

        foreach ($pesanan->detail_pesanan as $detail) {
            $total += $detail->menu->harga * $detail->jumlah;
        }

        return $total;
    }

    /**
     * function untuk menampilkan halaman home transaksi dengan join pesanan
     */
    public function home()
    {
        $transaksis = Transaksi::with('pesanan')->get();
        return view('transaksi.home', compact('transaksis'));
    }

    /**
     * function untuk menampilkan halaman pembayaran transaksi baru 
     * dan join dengan meja
     */
    public function vBayar()
    {
        $pesanans = Pesanan::with('meja')->get();
        return view('transaksi.new', compact('pesanans'));
    }

     /**
     * function untuk validasi input pembayaran transaksi
     */
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

     /**
     * function untuk mengexport ke excel
     */
    public function exportToExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
