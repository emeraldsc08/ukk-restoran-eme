<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meja;

class MejaController extends Controller
{
    private function new(Request $request)
    {
        $meja = new Meja();
        $meja->nomer = $request->input('nomer');
        $meja->save();
    }

    private function edit(Request $request, $id)
    {
        $meja = Meja::where('id', $id)->first();
        $meja->nomer = $request->input('nomer');
        $meja->save();
    }

    private function delete(Request $request)
    {
        $meja = Meja::where('id', $request->input('id'))->first();
        $meja->delete();
    }

    public function home()
    {
        $mejas = Meja::all();
        return view('meja.home', compact('mejas'));
    }

    public function vNew()
    {
        return view('meja.new');
    }

    public function vEdit($id)
    {
        $meja = Meja::where('id', $id)->first();
        return view('meja.edit', compact('meja'));
    }

    public function validateNew(Request $request)
    {
        $this->validate($request, [
            'nomer' => 'required|numeric'
        ]);

        $this->new($request);
        return redirect('/meja/home')->with('meja_success', 'Berhasil Menambah Meja!');
    }

    public function validateEdit(Request $request, $id)
    {
        $this->validate($request, [
            'nomer' => 'required|numeric'
        ]);

        $this->edit($request, $id);
        return redirect('/meja/home')->with('meja_success', 'Berhasil Mengubah Data Meja!');
    }

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric'
        ]);

        $this->delete($request);
        return redirect('/meja/home')->with('meja_success', 'Berhasil Menghapus Meja!');
    }

    public function getWithJson($id)
    {
        $meja = Meja::where('id', $id)->first();
        return response()->json($meja);
    }
}
