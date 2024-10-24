<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'member');
        })->get();
        return view('admin.data_member',compact('members'));
    }
    public function activate($id)
    {
        $member = User::findOrFail($id);
        if ($member->status == 'inactive') {
            $member->status = 'active';
            $member->save();

            Session::flash('status','success');
            Session::flash('message','Akun Member berhasil diaktifkan');
            return redirect()->route('data_member');
         }
            Session::flash('alert','error');
            Session::flash('message','Akun Member Sudah Aktif');
            return redirect()->route('data_member');
      }
    }
