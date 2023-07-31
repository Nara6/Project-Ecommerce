<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;

class CartController extends Controller
{
    public function read(Request $req){
        $data = Cart::select('*');
        if($req->user_id){
            $data = $data->where('user_id',$req->user_id);
        }
        $data = $data->with('product')
        ->get();
        return $data;
    }

    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'product_id' =>'required',
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }
        $cart = new Cart;
        $cart -> product_id = $req->product_id;
        $cart -> user_id = $req->user_id;
        $cart -> save();

        return response()->json(['success'=> true, 'data'=>$cart]);
    }
    public function remove($id){
        $data = Cart::find($id);
        if($data){

            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been deleted',
            ], 200);

        }else{

            return response()->json([
                'message' => 'Invalid data.',
            ], 400);

        }
    }
}
