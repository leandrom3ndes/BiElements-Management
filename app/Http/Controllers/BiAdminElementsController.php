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
            'bi_creator'=>'required',
            'bi_publish_date'=>'required',
            'bi_desc'=>'required',
        ]);
        // Image
        $image = $request->file('bi_cover_img');
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/bielements');
    
        $imageBase64 = base64_encode(file_get_contents($image));

        $image->move($destinationPath, $imageName);

        $bielement=new Bielement;
        $bielement->eng_id=$request->bi_eng;
        $bielement->bi_name=$request->bi_name;
        $bielement->bi_type=$request->bi_type;
        $bielement->bi_cover_img=$imageName;
        $bielement->bi_embed=$request->bi_embed;
        $bielement->bi_base64=$imageBase64;
        $bielement->bi_creator=$request->bi_creator;
        $bielement->bi_publish_date=$request->bi_publish_date;
        $bielement->bi_desc=$request->bi_desc;
        $bielement->save();
        return redirect('admin/bielement/add')->with('success','Bi Element adicionado com sucesso.');
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
            'bi_base64'=>'required',
            'bi_creator'=>'required',
            'bi_publish_date'=>'required',
            'bi_desc'=>'required',
        ]);
        // Image
        $image = $request->file('bi_cover_img');
        if($request->hasFile('bi_cover_img')){
            $imageBase64 = base64_encode(file_get_contents($image));
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/bielements');
            $image->move($destinationPath, $imageName);
            $bielement=Bielement::find($id);
            $bielement->eng_id=$request->bi_eng;
            $bielement->bi_name=$request->bi_name;
            $bielement->bi_type=$request->bi_type;
            $bielement->bi_cover_img=$imageName;
            $bielement->bi_embed=$request->bi_embed;
            $bielement->bi_base64=$imageBase64;
            $bielement->bi_creator=$request->bi_creator;
            $bielement->bi_publish_date=$request->bi_publish_date;
            $bielement->bi_desc=$request->bi_desc;
            $bielement->save();
        }else{
            $imageName=$request->prev_img;
            // Save BiElements Nop saving previous image
            $bielement=Bielement::find($id);
            $bielement->eng_id=$request->bi_eng;
            $bielement->bi_name=$request->bi_name;
            $bielement->bi_type=$request->bi_type;
            $bielement->bi_cover_img=$imageName;
            $bielement->bi_embed=$request->bi_embed;
            $bielement->bi_base64=$request->bi_base64;
            $bielement->bi_creator=$request->bi_creator;
            $bielement->bi_publish_date=$request->bi_publish_date;
            $bielement->bi_desc=$request->bi_desc;
            $bielement->save();
            
        }
        return redirect('admin/bielement/update/'.$id)->with('success','Bi Element atualizado com sucesso.');
    }
    // Delete Data
    function delete($id){
        Bielement::where('id',$id)->delete();
        return redirect('admin/bielements')->with('success','Os dados foram eliminados.');
    }
}
