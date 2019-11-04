<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meja;

class MejaController extends Controller
{
     /**
     * function untuk menambah meja baru
     */
    private function new(Request $request)
    {
        $meja = new Meja();
        $meja->nomer = $request->input('nomer');
        $meja->save();
    }

     /**
     * function untuk mengubah data meja
     */
    private function edit(Request $request, $id)
    {
        $meja = Meja::where('id', $id)->first();
        $meja->nomer = $request->input('nomer');
        $meja->save();
    }

     /**
     * function untuk menghapus data meja
     */
    private function delete(Request $request)
    {
        $meja = Meja::where('id', $request->input('id'))->first();
        $meja->delete();
    }

     /**
     * function untuk menampilkan view semua meja
     */
    public function home()
    {
        $mejas = Meja::all();
        return view('meja.home', compact('mejas'));
    }

      /**
     * function untuk menampilkan view penambahan meja baru
     */
    public function vNew()
    {
        return view('meja.new');
    }

     /**
     * function untuk menampilkan view pengubahan data meja
     */
    public function vEdit($id)
    {
        $meja = Meja::where('id', $id)->first();
        return view('meja.edit', compact('meja'));
    }

     /**
     * function untuk validasi input penambahan meja baru
     */
    public function validateNew(Request $request)
    {
        $this->validate($request, [
            'nomer' => 'required|numeric'
        ]);

        $this->new($request);
        return redirect('/meja/home')->with('meja_success', 'Berhasil Menambah Meja!');
    }

    /**
     * function untuk validasi input pengubahan data meja
     */
    public function validateEdit(Request $request, $id)
    {
        $this->validate($request, [
            'nomer' => 'required|numeric'
        ]);

        $this->edit($request, $id);
        return redirect('/meja/home')->with('meja_success', 'Berhasil Mengubah Data Meja!');
    }

    /**
     * function untuk validasi input penghapusan data meja
     */
    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric'
        ]);

        $this->delete($request);
        return redirect('/meja/home')->with('meja_success', 'Berhasil Menghapus Meja!');
    }

    /**
     * function untuk menampilkan data meja dengan json
     */
    public function getWithJson($id)
    {
        $meja = Meja::where('id', $id)->first();
        return response()->json($meja);
    }
}
