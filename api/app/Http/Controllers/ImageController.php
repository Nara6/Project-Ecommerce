<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
class ImageController extends Controller
{
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'image_url' =>'required|mimes:jpeg,png,jpg',
            'product_id' =>'required|exists:product,id'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>true,'message'=>$validator->errors()],401);
        }
        $image = new Image;
        if($req->hasFile('image_url')){
            $fileName = time().'_'.$req->image_url->getClientOriginalName();
            $filePath = $req->file('image_url')->storeAs('uploads', $fileName, 'public');
            $image -> image_url = '/storage/'.$filePath;
            $image -> product_id = $req->product_id;
        }else{
            $image -> image_url = '';
            $image -> product_id = $req->product_id;
        }
        
        $image->save();
        return response()->json(['success'=> true, 'data'=>$image],200);
    }
}
