<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function read(){
        return $data = OrderDetail::select('*')->with(['product','order'])->get();
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'order_id' =>'required|exists:order,id',
            'product_id'=> 'required|exists:product,id',
            'quantity'=>'required|integer',
            'price' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],401);
        }
        $orderDetail = new OrderDetail;

        $orderDetail -> order_id  =$req['order_id'];
        $orderDetail -> product_id=$req['product_id'];
        $orderDetail -> quantity= $req ['quantity'] ;
        $orderDetail -> price= $req ['price'] ;
        $orderDetail -> discount = $req['discount'] ?? null;
        $orderDetail -> save();
        return response()->json(["success"=> true, 'order_detal'=>$orderDetail],200);
    }
    public function getOrderDetailById($id){
        $data = OrderDetail::select('*')->where("id",$id)->with(['product','order'])->get();
        return $data;
    }
}
