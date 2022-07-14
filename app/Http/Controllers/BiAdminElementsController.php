<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Bielement;
use App\Engine;
class BiAdminElementsController extends Controller
{
    // Get All BiElements
    function all(){
        $bielements=Bielement::all();
        return view('backend.bielements.all',[
            'bielements'=>$bielements
        ]);
    }
    // Add BiElements Form
    function add_form(){
        $engines=Engine::all();
        return view('backend.bielements.add',[
            'engines'=>$engines
        ]);
    }
    // Submit Add Form
    function submit_add_form(Request $request){
        $request->validate([
            'bi_eng'=>'required',
            'bi_name'=>'required',
            'bi_type'=>'required',
            'bi_cover_img'=>'required',
            'bi_embed'=>'required',
            'bi_base64'=>'required',
            'bi_creator'=>'required',
            'bi_publish_date'=>'required',
            'bi_desc'=>'required',
        ]);
        // Image
        $image = $request->file('bi_cover_img');
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/bielements');
        $image->move($destinationPath, $imageName);
        // PDF
        /*$pdf = $request->file('bi_embed');
        $pdfName=time().'.'.$pdf->getClientOriginalExtension();
        $pdf->move($destinationPath, $pdfName);*/
        // Save BiElements
        $book=new Bielement;
        $book->eng_id=$request->bi_eng;
        $book->bi_name=$request->bi_name;
        $book->bi_type=$request->bi_type;
        $book->bi_cover_img=$imageName;
        $book->bi_embed=$request->bi_embed;
        $book->bi_base64=$request->bi_base64;
        $book->bi_creator=$request->bi_creator;
        $book->bi_publish_date=$request->bi_publish_date;
        $book->bi_desc=$request->bi_desc;
        $book->save();
        return redirect('admin/book/add')->with('success','Data has been added.');
    }

    // Edit View
    function edit($id){
        $allData=Bielement::find($id);
        $engines=Engine::all();
        return view('backend.bielements.edit',['allData'=>$allData,'engines'=>$engines]);
    }
    // Update Data
    function update(Request $request,$id){
        $request->validate([
            'bi_eng'=>'required',
            'bi_name'=>'required',
            'bi_type'=>'required',
            'bi_embed'=>'required',
            'bi_creator'=>'required',
            'bi_publish_date'=>'required',
            'bi_desc'=>'required',
        ]);
        // Image
        if($request->hasFile('bi_cover_img')){
            $image = $request->file('bi_cover_img');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/bielements');
            $image->move($destinationPath, $imageName);
        }else{
            $imageName=$request->prev_img;
        }

        // PDF
        /*if($request->hasFile('bi_cover_img')){
            $pdf = $request->file('bi_embed');
            $pdfName=time().'.'.$pdf->getClientOriginalExtension();
            $pdf->move($destinationPath, $pdfName);
        }else{
            $pdfName=$request->prev_pdf;
        }*/

        // Save BiElements
        $book=Bielement::find($id);
        $book->eng_id=$request->bi_eng;
        $book->bi_name=$request->bi_name;
        $book->bi_type=$request->bi_type;
        $book->bi_cover_img=$imageName;
        $book->bi_embed=$request->bi_embed;
        $book->bi_base64=$request->bi_base64;
        $book->bi_creator=$request->bi_creator;
        $book->bi_publish_date=$request->bi_publish_date;
        $book->bi_desc=$request->bi_desc;
        $book->save();
        return redirect('admin/book/update/'.$id)->with('success','Data has been updated.');
    }
    // Delete Data
    function delete($id){
        Bielement::where('id',$id)->delete();
        return redirect('admin/bielements')->with('success','Data has been deleted.');
    }
}
