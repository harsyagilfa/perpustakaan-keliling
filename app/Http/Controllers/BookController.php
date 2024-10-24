<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return view('admin.data_buku',compact('books'));
    }
    public function tambah_Buku()
    {
        return view('admin.tambah_Buku');
    }
    public function tambah_buku_aksi(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publish_year' => 'required',
            'status' => 'required',
        ]);
        Books::create($request->all());
        Session::flash('status','success');
        Session::flash('message','Data Buku Berhasil Ditambahkan');
        return redirect()->route('data_buku');
    }
    public function delete_buku($id)
    {
        $books = Books::findOrFail($id);
        $books->delete();
        Session::flash('alert','gagal');
        Session::flash('message','Data Buku Berhasil Dihapus');
        return redirect()->route('data_buku');
    }
    public function update_buku($id)
    {
        $books = Books::find($id);
        return view('admin.update_buku',compact('books'));
    }
    public function update_buku_aksi(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publish_year' => 'required',
            'status' => 'required',
        ]);
        $books = Books::find($id);
        $books->update($request->all());
        Session::flash('status','success');
        Session::flash('message','Data Buku Berhasil Diupdate');
        return redirect()->route('data_buku');

    }
}
