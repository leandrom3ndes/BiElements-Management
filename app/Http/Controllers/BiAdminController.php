<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class BiAdminController extends Controller
{
    // Admin Login
    function login(){
        return view('backend.admin');
    }
    // Submit Admin Login Form
    function login_submit(Request $request){
        $request->validate([
            'username'=>'required',
            'pwd'=>'required'
        ]);
        $findAdmin=Admin::where([
            'admin'=>$request->username,
            'pwd'=>$request->pwd
        ])->count();
        if($findAdmin>0){
            session(['adminLogged'=>true]);
            return redirect('admin/dashboard');
        }else{
            return redirect('admin/login')->with('error','Invalid Username/Password!!');
        } 
    }
    // Admin Dashboard
    function dashboard(){
        return view('backend.admin-dashboard');
    }

    // Admin Logout
    function logout(){
        session()->forget('adminLogged');
        return redirect('/');
    }
}
