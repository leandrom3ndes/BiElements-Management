<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Knowage;


class BiKnowageController extends Controller
{
    // Return JSON for all Knowage elements
    function all(){
        $request = json_decode(file_get_contents('php://input'));
        if(!isset($request->page) || $request->page==1){
            $limitknowage=DB::table('knowages')
            ->orderBy('id','desc')
            ->limit(12)
            ->get();
        }else{
            $offset=$request->page*($request->limit);
            $limitknowage=DB::table('knowages')
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit($request->limit)
            ->get();
        }
        $allknowage=DB::table('knowages')->count();
        return response()->json(['allknowage'=>$limitknowage,'totalknowage'=>$allknowage]);
    }

    // Return JSON for Single Knowage
    function detail(){
        $request = json_decode(file_get_contents('php://input'));
        $knowages=Knowage::find($request->knowage_id);
        return response()->json($knowages);
    }

    // Search BiElements
    function search(){
        $request = json_decode(file_get_contents('php://input'));
        $search=$request->searchText;
        $limitknowage = Knowage::where('documentName','LIKE',"%{$search}%")->orderBy('id','desc')->limit(12)->get();
        $allknowage = Knowage::where('documentName','LIKE',"%{$search}%")->count();
        return response()->json(['allknowage'=>$limitknowage,'totalknowage'=>$allknowage]);
    }

}
