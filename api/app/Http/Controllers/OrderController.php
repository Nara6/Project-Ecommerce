<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
class OrderController extends Controller
{
    public function read(){
        return $data = Order::select('*')->get();
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'user_id'=> 'required|exists:user,id',
            'total_price'=> 'required|numeric',
            'shipping_address' => 'required',
            'shipping_country' => 'required',
            'shipping_city' => 'required',
            'shipping_postalcode' => 'required',
            'shipping_method' => 'required',
            'billing_address' => 'required',
            'billing_country' =>'required',
            'billing_city' =>'required',
            'billing_postalcode' =>'required',
            'card_number' => 'required|numeric|digits:16',
            'card_type' => 'required',
            'cardholder_name' => 'required',
            'expired_date' => 'required',
            'cvv'  => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json(['message' => "Validation failed", 'errors' =>  $validator->errors()],401);
        }
        $order = new Order;
        $order -> user_id= $req->user_id;
        $order -> total_price= $req->total_price;
        $order -> discount = $req->discount ?? null;
        $order -> shipping_address = $req->shipping_address;
        $order -> shipping_country=$req->shipping_country ;
        $order -> shipping_city =$req->shipping_city;
        $order -> shipping_postalcode = $req->shipping_postalcode;
        $order -> shipping_method = $req->shipping_method;
        $order -> billing_address = $req->billing_address;
        $order -> billing_country = $req->billing_country;
        $order -> billing_city = $req->billing_city;
        $order -> billing_postalcode = $req->billing_postalcode;
        $order -> card_number = $req->card_number;
        $order -> card_type = $req->card_type;
        $order -> cardholder_name = $req->cardholder_name;
        $order -> expired_date = $req->expired_date;
        $order -> cvv = $req->cvv;
        $order -> order_at = now();
        $order -> save();
        return response()->json(['message' => "success", 'order'=>$order],200);
    }
}
