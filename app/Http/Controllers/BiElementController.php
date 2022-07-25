<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Bielement;
class BiElementController extends Controller
{
    // Home Page
    function index(){
        return view('front.index');
    }

    // Return JSON for all BiElements
    function all(){
        $request = json_decode(file_get_contents('php://input'));
        if(!isset($request->page) || $request->page==1){
            $limitbielements=DB::table('bielements')
            ->orderBy('id','desc')
            ->limit(12)
            ->get();
        }else{
            $offset=$request->page*($request->limit);
            $limitbielements=DB::table('bielements')
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit($request->limit)
            ->get();
        }
        $allbielements=DB::table('bielements')->count();
        return response()->json(['allbielements'=>$limitbielements,'totalbielements'=>$allbielements]);
    }

    // Return JSON for Single Bielement
    function detail(){
        $request = json_decode(file_get_contents('php://input'));
        $bielements=Bielement::find($request->bi_id);
        return response()->json($bielements);
    }

    // Search BiElements
    function search(){
        $request = json_decode(file_get_contents('php://input'));
        $search=$request->searchText;
        $limitbielements = Bielement::where('bi_name','LIKE',"%{$search}%")->orderBy('id','desc')->limit(12)->get();
        $allbielements = Bielement::where('bi_name','LIKE',"%{$search}%")->count();
        return response()->json(['allbielements'=>$limitbielements,'totalbielements'=>$allbielements]);
    }
}
