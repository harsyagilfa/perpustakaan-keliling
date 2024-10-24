<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookloanController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return view('member.pinjam_buku',compact('books'));
    }
    public function loan($id)
    {
        $books = Books::findOrFail($id);
        if ($books->status == 'available') {
            // Membuat record peminjaman di table loans
            Loan::create([
                'user_id' => Auth::id(),
                'book_id' => $books->id,
                'loan_date' => now(),
                'status' => 'on_loan',
            ]);
            $books->update(['status' => 'empty']);
            Session::flash('status','success');
            Session::flash('message','Buku Berhasil Dipinjam');
            return redirect()->route('pinjam_buku');
        }

    }
}
