<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\JenisMenu;

class MenuController extends Controller
{
    private function new(Request $request)
    {
        $menu = new Menu();
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->id_jenis_menu = $request->input('jenis_menu');
        $menu->save();
    }

    private function edit(Request $request, $id)
    {
        $menu = Menu::where('id', $id)->first();
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->status = $request->input('status');
        $menu->save();
    }

    private function delete(Request $request)
    {
        $menu = Menu::where('id', $request->input('id'))->first();
        $menu->delete();
    }

    public function home()
    {
        $menus = Menu::with('jenisMenu')->get();
        return view('menu.home', compact('menus'));
    }

    public function vNew()
    {
        $jenis_menus = JenisMenu::all();
        return view('menu.new', compact('jenis_menus'));
    }

    public function vEdit($id)
    {
        $menu = Menu::where('id', $id)->with('jenisMenu')->first();
        $jenis_menus = JenisMenu::all();
        return view('menu.edit', compact('menu', 'jenis_menus'));
    }

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

    public function validateDelete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        
        $this->delete($request);
        return redirect()->back()->with('menu_success', 'Berhasil menghapus menu!');
    }

    public function getWithJson($id)
    {
        $menu = Menu::where('id', $id)->with('jenisMenu')->first();
        return response()->json($menu);
    }
}
