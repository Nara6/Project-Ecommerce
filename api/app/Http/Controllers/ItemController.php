<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        $data = Item::select('*')->with(['category'])
        ->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required',
            'description'=> 'required',
            'category_id'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 200);
        }
        if(!Category::find($req->category_id)){
            return response()->json(['error' => 'Invalid category'], 400);
        }

        $item = new Item;
        if($req->hasFile('image_url')){
            $fileName = time().'_'.$req->image_url->getClientOriginalName();
            $filePath = $req->file('image_url')->storeAs('uploads', $fileName, 'public');
            $item->name = $req->name;
            $item->description = $req->description;
            $item->category_id = $req->category_id;
            $item->image_url = '/storage/'.$filePath;
        }else{
            $item->name = $req->name;
            $item->description = $req->description;
            $item->category_id = $req->category_id;
            $item->image_url = 'no image';
        }
        $item->save();
        return response()->json([
            'category' => $item,
            'message' => 'item has been successfully created.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
