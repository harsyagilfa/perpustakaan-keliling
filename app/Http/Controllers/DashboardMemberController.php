<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardMemberController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $loans = Loan::with('book')
        ->where('user_id', $userId)
        ->where('status', 'on_loan')
        ->get();
        return view('member.dashboard',compact('loans'));
    }
    public function returnBook($id)
    {
        $loans = Loan::findOrFail($id);
        $books = Books::findOrFail($loans->book_id);
        $books->status = 'available';
        $books->save();

         $loans->status = 'returned';
         $loans->return_date = now();
         $loans->save();

         Session::flash('status','success');
         Session::flash('message','Buku Berhasil Dikembalikan');
         return redirect()->route('member.dashboard');

    }

}
