<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Item;
use App\Models\Color;
use App\Models\Product;



class ProductController extends Controller
{
    public function read(Request $req){
        $data = Product::select('*')->with(['category', 'item','image']);
        if($req->category_id && $req->category_id != 0){
            $data = $data->where('category_id', $req->category_id);
        }
        if($req->item_id && $req->item_id != 0){
            $data = $data->where('item_id', $req->item_id);
        }
        $data = $data->orderBy('id', 'DESC')
        ->get();
        return $data;
    }
    public function getProductById(){
        $data = Product::select('*')->where(['category_id' => $categoryId])->get();
        return $data;
    }

    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'description'=> 'required',
            'note'=> 'required|min:10',
            'price'=> 'required|numeric',
            'title'=> 'required|max:100',
            'category_id'=> 'required|numeric',
            'item_id'=> 'required|numeric',
            'image_url.*'=> 'required|image',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true,'message' => "Validation failed", 'errors'=> $validator->errors()]);
        }
        $category = new Category;
        $item = new Item;
        $color = new Color;
        if(!$category::find($req->category_id)){
            return response()->json(['error' => 'Category id is invalid']);
        }
        if(!$item::find($req->item_id)){
            return response()->json(['error' => 'Item id is invalid']);
        }
        $product = new Product;
        if($req->hasFile('image_url')){
            $fileName = time().'_'.$req->image_url->getClientOriginalName();
            $filePath = $req->file('image_url')->storeAs('uploads', $fileName, 'public');
            $product -> title       = $req->title;
            $product -> description = $req->description;
            $product -> note        = $req->note;
            $product -> price       = $req->price;
            $product -> category_id = $req->category_id;
            $product -> item_id     = $req->item_id;
            $product -> image_url   = '/storage/'.$filePath;
        }else{
            $product -> title       = $req->title;
            $product -> description = $req->description;
            $product -> note        = $req->note;
            $product -> price       = $req->price;
            $product -> category_id = $req->category_id;
            $product -> item_id     = $req->item_id;
            $product -> image_url   = '';
        }
        $product->save();
        return response()->json([
            'product' => $product,
            'message' => 'product has been successfully created.'
        ], 200);
    }
}
