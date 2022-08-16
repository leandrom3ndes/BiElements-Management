<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Knowage;

class BiAdminKnowageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowage=Knowage::all();
        return view('backend.knowage.all',['allData'=>$knowage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.knowage.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'documentLabel'=>'required',
            'documentName'=>'required',
            'knowage_cover_img'=>'required',
            'documentType'=>'required',
            'documentDescription'=>'required',
            'executionRole'=>'required',
            'displayToolbar'=>'required',
            'canResetParameters'=>'required',
            'displaySliders'=>'required',
            'datasetLabel'=>'required'
        ]);
        // Image
        $image = $request->file('knowage_cover_img');
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/knowages');

        $imageBase64 = base64_encode(file_get_contents($image));

        $image->move($destinationPath, $imageName);

        $knowage=new Knowage;
        $knowage->documentLabel=$request->documentLabel;
        $knowage->documentName=$request->documentName;
        $knowage->knowage_cover_img=$imageName;
        $knowage->knowage_base64=$imageBase64;
        $knowage->documentType=$request->documentType;
        $knowage->documentDescription=$request->documentDescription;
        $knowage->executionRole=$request->executionRole;
        $knowage->displayToolbar=$request->displayToolbar;
        $knowage->canResetParameters=$request->canResetParameters;
        $knowage->displaySliders=$request->displaySliders;
        $knowage->datasetLabel=$request->datasetLabel;
        $knowage->save();

        return redirect('admin/knowage/add')->with('success','Dados adicionados com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $knowage=Knowage::find($id);
        return view('backend.knowage.edit',['allData'=>$knowage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'documentLabel'=>'required',
            'documentName'=>'required',
            'knowage_base64'=>'required',
            'documentType'=>'required',
            'documentDescription'=>'required',
            'executionRole'=>'required',
            'displayToolbar'=>'required',
            'canResetParameters'=>'required',
            'displaySliders'=>'required',
            'datasetLabel'=>'required'
        ]);
        // Image
        if($request->hasFile('knowage_cover_img')){
            $image = $request->file('knowage_cover_img');

            $imageBase64 = base64_encode(file_get_contents($image));

            $imageName=time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/knowages');
            $image->move($destinationPath, $imageName);

            $knowage=Knowage::find($id);
            $knowage->documentLabel=$request->documentLabel;
            $knowage->documentName=$request->documentName;
            $knowage->knowage_cover_img=$imageName;
            $knowage->knowage_base64=$imageBase64;
            $knowage->documentType=$request->documentType;
            $knowage->documentDescription=$request->documentDescription;
            $knowage->executionRole=$request->executionRole;
            $knowage->displayToolbar=$request->displayToolbar;
            $knowage->canResetParameters=$request->canResetParameters;
            $knowage->displaySliders=$request->displaySliders;
            $knowage->datasetLabel=$request->datasetLabel;
            $knowage->save();
        }else{
            $imageName=$request->prev_img;

            $knowage=Knowage::find($id);
            $knowage->documentLabel=$request->documentLabel;
            $knowage->documentName=$request->documentName;
            $knowage->knowage_cover_img=$imageName;
            $knowage->knowage_base64=$request->knowage_base64;
            $knowage->documentType=$request->documentType;
            $knowage->documentDescription=$request->documentDescription;
            $knowage->executionRole=$request->executionRole;
            $knowage->displayToolbar=$request->displayToolbar;
            $knowage->canResetParameters=$request->canResetParameters;
            $knowage->displaySliders=$request->displaySliders;
            $knowage->datasetLabel=$request->datasetLabel;
            $knowage->save();
        }
        
        return redirect('admin/knowage/update/'.$id)->with('success','Dados atualizados com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Knowage::where('id',$id)->delete();
        return redirect('admin/knowage')->with('success','Eliminado com sucesso.');
    }
}
