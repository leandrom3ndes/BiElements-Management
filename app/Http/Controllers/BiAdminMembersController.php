<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
class BiAdminMembersController extends Controller
{
    // All members
    function index(){
        $allData=Member::all();
        return view('backend.member.all',['allData'=>$allData]);
    }
    // Delete Member
    function delete($id){
        Member::where('member_id',$id)->delete();
        return redirect('admin/members')->with('success','Member has been deleted.');
    }
}
