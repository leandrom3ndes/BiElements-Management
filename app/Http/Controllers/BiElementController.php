<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Book;
class BiElementController extends Controller
{
    // Home Page
    function index(){
        return view('front.index');
    }

    // Return JSON for all Books
    function all(){
        $request = json_decode(file_get_contents('php://input'));
        if(!isset($request->page) || $request->page==1){
            $limitBooks=DB::table('books')
            ->orderBy('id','desc')
            ->limit(12)
            ->get();
        }else{
            $offset=$request->page*($request->limit);
            $limitBooks=DB::table('books')
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit($request->limit)
            ->get();
        }
        $allBooks=DB::table('books')->count();
        return response()->json(['allBooks'=>$limitBooks,'totalBooks'=>$allBooks]);
    }

    // Return JSON for Single Book
    function detail(){
        $request = json_decode(file_get_contents('php://input'));
        $books=Book::find($request->book_id);
        return response()->json($books);
    }

    // Search Books
    function search(){
        $request = json_decode(file_get_contents('php://input'));
        $search=$request->searchText;
        $limitBooks = Book::where('book_name','LIKE',"%{$search}%")->orderBy('id','desc')->limit(12)->get();
        $allBooks = Book::where('book_name','LIKE',"%{$search}%")->count();
        return response()->json(['allBooks'=>$limitBooks,'totalBooks'=>$allBooks]);
    }
}
