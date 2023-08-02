<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\FileUpload\FileUpload;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read(Request $req)
    {
        $page = $req->has('page') ? $req->get('page') : 1;
        $limit = $req->has('limit') ? $req->get('limit'): 5;
        $data = Category::select('*')->with('item')->limit($limit)->offset(($page-1)*$limit)->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryById($id){
        $data = Category::select('*')->where("id",$id)->with(['item'])->get();
        return $data;
    }
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required',
            'description'=> 'required',
            'image_url'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->messages()], 200);
        }
        $category = new Category;
        if($req->hasFile('image_url')){
            $fileName = time().'_'.$req->image_url->getClientOriginalName();
            $filePath = $req->file('image_url')->storeAs('uploads', $fileName, 'public');
            $category->name = $req->name;
            $category->description = $req->description;
            $category->image_url = '/storage/'.$filePath;
        }
        $category->save();
        return response()->json([
            'category' => $category,
            'message' => 'Category has been successfully created.'
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
