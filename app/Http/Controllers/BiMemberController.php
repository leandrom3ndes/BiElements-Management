<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiMemberController extends Controller
{
    // Member Register
    function member_register(){
        $request = json_decode(file_get_contents('php://input'));
        $addMember=DB::table('members')->insert([
            'member_name'=>$request->member_fullname,
            'member_email'=>$request->member_email,
            'member_pwd'=>$request->member_pwd,
            'created_at'=>new \DateTime(),
            'updated_at'=>new \DateTime()
        ]);
        if($addMember){
            $msg='Thank you for creating account with us.';
            $bool=true;
        }else{
            $msg='Error creating your account!';
            $bool=false;
        }
        echo json_encode(['msg'=>$msg,'bool'=>$bool]);
    }
    // Member Login
    function member_login(){
        $res=array();
        session()->forget(['loggedIn', 'memberData']);
        $request = json_decode(file_get_contents('php://input'));
        $memberCount=DB::table("members")
        ->where(['member_email'=>$request->member_email,'member_pwd'=>$request->member_pwd])
        ->count();
        if($memberCount>0){
            $memberData=DB::table("members")
            ->where(['member_email'=>$request->member_email,'member_pwd'=>$request->member_pwd])
            ->get();
            session(['loggedIn' =>true,'memberData'=>$memberData]);
            $res['bool']=true;
            $res['memberData']=session('memberData');
        }else{
            $res['bool']=false;
        }
        echo json_encode($res);
    }
    // Member Profile
    function member_profile(){
        
    }
    // Member Logout
    function member_logout(){
        session()->forget(['loggedIn', 'memberData']);
        echo json_encode(['bool'=>true]);
    }
    // Check session and get all userdata
    function check_session(){
        $res=array();
        if(session('memberData')){
            $res['bool']=true;
            $res['memberData']=session('memberData');
        }else{
            $res['bool']=false;
        }
        echo json_encode($res);
    }
    // Collect Specific Bielement
    function collect(){
        $res=array();
        $request = json_decode(file_get_contents('php://input'));
        $checkCollection=DB::table('my_collection')
        ->where([
            'bi_id'=>$request->bi_id,
            'member_id'=>$request->member_id
        ])->count();
        if($checkCollection>0){
            $res['bool']=false;
        }else{
            $saveCollection=DB::table('my_collection')
            ->insert([
                'bi_id'=>$request->bi_id,
                'member_id'=>$request->member_id
            ]);
            $res['bool']=true;
        }
        echo json_encode($res);
    }

    // fetch my collection
    function my_collection(){
        $res=array();
        $checkCollection=DB::table('my_collection')
        ->join('bielements','my_collection.bi_id','=','bielements.id')
        ->where([
            'my_collection.member_id'=>session('memberData')[0]->member_id
        ])->get();
        $res['allData']=$checkCollection;
        echo json_encode($res);
    }
}