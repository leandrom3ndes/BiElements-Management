<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Engine;
class BiAdminElementsController extends Controller
{
    // Get All Books
    function all(){
        $books=Book::all();
        return view('backend.books.all',[
            'books'=>$books
        ]);
    }
    // Add Books Form
    function add_form(){
        $engines=Engine::all();
        return view('backend.books.add',[
            'engines'=>$engines
        ]);
    }
    // Submit Add Form
    function submit_add_form(Request $request){
        $request->validate([
            'book_cat'=>'required',
            'book_name'=>'required',
            'book_img'=>'required',
            'book_pdf'=>'required',
            'book_publish'=>'required',
            'book_author'=>'required',
            'book_publisher'=>'required',
            'book_publish'=>'required',
            'book_desc'=>'required',
        ]);
        // Image
        $image = $request->file('book_img');
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/books');
        $image->move($destinationPath, $imageName);
        // PDF
        $pdf = $request->file('book_pdf');
        $pdfName=time().'.'.$pdf->getClientOriginalExtension();
        $pdf->move($destinationPath, $pdfName);
        // Save Books
        $book=new Book;
        $book->eng_id=$request->book_cat;
        $book->book_name=$request->book_name;
        $book->book_desc=$request->book_desc;
        $book->book_cover_img=$imageName;
        $book->book_pdf=$pdfName;
        $book->book_price=$request->book_price;
        $book->book_author=$request->book_author;
        $book->book_publisher=$request->book_publisher;
        $book->book_publish_date=$request->book_publish;
        $book->save();
        return redirect('admin/book/add')->with('success','Data has been added.');
    }

    // Edit View
    function edit($id){
        $allData=Book::find($id);
        $engines=Engine::all();
        return view('backend.books.edit',['allData'=>$allData,'engines'=>$engines]);
    }
    // Update Data
    function update(Request $request,$id){
        $request->validate([
            'book_cat'=>'required',
            'book_name'=>'required',
            'book_publish'=>'required',
            'book_author'=>'required',
            'book_publisher'=>'required',
            'book_publish'=>'required',
            'book_desc'=>'required',
        ]);
        // Image
        if($request->hasFile('book_img')){
            $image = $request->file('book_img');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/books');
            $image->move($destinationPath, $imageName);
        }else{
            $imageName=$request->prev_img;
        }

        // PDF
        if($request->hasFile('book_img')){
            $pdf = $request->file('book_pdf');
            $pdfName=time().'.'.$pdf->getClientOriginalExtension();
            $pdf->move($destinationPath, $pdfName);
        }else{
            $pdfName=$request->prev_pdf;
        }

        // Save Books
        $book=Book::find($id);
        $book->eng_id=$request->book_cat;
        $book->book_name=$request->book_name;
        $book->book_desc=$request->book_desc;
        $book->book_cover_img=$imageName;
        $book->book_pdf=$pdfName;
        $book->book_price=$request->book_price;
        $book->book_author=$request->book_author;
        $book->book_publisher=$request->book_publisher;
        $book->book_publish_date=$request->book_publish;
        $book->save();
        return redirect('admin/book/update/'.$id)->with('success','Data has been updated.');
    }
    // Delete Data
    function delete($id){
        Book::where('id',$id)->delete();
        return redirect('admin/books')->with('success','Data has been deleted.');
    }
}
