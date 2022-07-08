<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BiEngineController extends Controller
{
    // Get All Engines
    function all(){
        $engines=DB::table('engines')->get();
        return response()->json(['allCats'=>$engines]);
    }

    // Return JSON for all Books
    function engine($eng_id){
        $limitBooks=DB::table('books')
        ->where('eng_id',$eng_id)
        ->get();
        $catDetail=DB::table('engines')
        ->where('eng_id',$eng_id)
        ->get();
        $allBooks=DB::table('books')
        ->where('eng_id',$eng_id)
        ->count();
        return response()->json(['allBooks'=>$limitBooks,'totalBooks'=>$allBooks,'eng_name'=>$catDetail[0]->eng_name]);
    }
}
