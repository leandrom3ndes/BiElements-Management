<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Engine;
class BiAdminEnginesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engines=Engine::all();
        return view('backend.engine.all',['allData'=>$engines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.engine.add');
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
            'eng_name'=>'required',
            'eng_desc'=>'required',
            'eng_img'=>'required'
        ]);
        // Image
        $image = $request->file('eng_img');
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/cats');
        $image->move($destinationPath, $imageName);
        $cat=new Engine;
        $cat->eng_name=$request->eng_name;
        $cat->eng_desc=$request->eng_desc;
        $cat->eng_img=$imageName;
        $cat->save();
        return redirect('admin/engine/add')->with('success','Data has been added.');
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
        $engine=Engine::find($id);
        return view('backend.engine.edit',['allData'=>$engine]);
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
            'eng_name'=>'required',
            'eng_desc'=>'required'
        ]);
        // Image
        if($request->hasFile('eng_img')){
            $image = $request->file('eng_img');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/cats');
            $image->move($destinationPath, $imageName);
        }else{
            $imageName=$request->prev_img;
        }
        $cat=Engine::find($id);
        $cat->eng_name=$request->eng_name;
        $cat->eng_desc=$request->eng_desc;
        $cat->eng_img=$imageName;
        $cat->save();
        return redirect('admin/engine/update/'.$id)->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Engine::where('eng_id',$id)->delete();
        return redirect('admin/engines');
    }
}
