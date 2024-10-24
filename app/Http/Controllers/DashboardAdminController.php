<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Books;
use App\Models\Roles;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $books   = Books::count();
        $loans      = Loan::count();
        $roleId = Roles::where('role_name', 'member')->first()->id;
        $member  = User::where('role_id',$roleId)->count();
        return view('admin.dashboard',compact('books','loans','member'));
    }
}
