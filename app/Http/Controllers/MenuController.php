<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\JenisMenu;

class MenuController extends Controller
{
    /**
     * function untuk menambah menu baru
     */
    private function new(Request $request)
    {
        $menu = new Menu();
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->id_jenis_menu = $request->input('jenis_menu');
        $menu->save();
    }

    /**
     * function untuk mengubah data menu
     */
    private function edit(Request $request, $id)
    {
        $menu = Menu::where('id', $id)->first();
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->id_jenis_menu = $request->input('jenis_menu');
        $menu->status = $request->input('status');
        $menu->save();
    }

    /**
     * function untuk menghapus data menu
     */
    private function delete(Request $request)
    {
        $menu = Menu::where('id', $request->input('id'))->first();
        $menu->delete();
    }

    /**
     * function untuk menampilkan semua menu
     */
    public function home()
    {
        $menus = Menu::with('jenisMenu')->get();
        return view('menu.home', compact('menus'));
    }

    /**
     * function untuk menampilkan view penambahan menu
     */
    public function vNew()
    {
        $jenis_menus = JenisMenu::all();
        return view('menu.new', compact('jenis_menus'));
    }

    /**
     * function untuk menampilkan view pengubahan menu
     */
    public function vEdit($id)
    {
        $menu = Menu::where('id', $id)->with('jenisMenu')->first();
        $jenis_menus = JenisMenu::all();
        return view('menu.edit', compact('menu', 'jenis_menus'));
    }

    /**
     * function untuk validasi input penambahan menu
     */
    public function validateNew(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'jenis_menu' => 'required'
        ]);

        $this->new($request);
        return redirect('/menu/home')->with('menu_success', 'Berhasil menambah menu!');
    }

    /**
     * function untuk validasi input pengubahan menu
     */
    public function validateEdit(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'jenis_menu' => 'required|numeric',
            'status' => 'required'
        ]);

        $this->edit($request, $id);
        return redirect('/menu/home')->with('menu_success', 'Berhasil mengubah data menu!');
    }

    /**
     * function untuk validasi input penghapusan menu
     */
    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        
        $this->delete($request);
        return redirect()->back()->with('menu_success', 'Berhasil menghapus menu!');
    }

    /**
     * function untuk mendapatkan menu dengan json
     */
    public function getWithJson($id)
    {
        $menu = Menu::where('id', $id)->with('jenisMenu')->first();
        return response()->json($menu);
    }
}
