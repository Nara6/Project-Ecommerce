<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\Validator;

class ShippingMethodController extends Controller
{
    public function read(){
        $data = ShippingMethod::select('*')->get();
        return $data;
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'name' =>'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }
        $shippingMethod = new ShippingMethod;
        $shippingMethod -> name         =   $req->name;
        $shippingMethod -> description  =   $req->description;
        $shippingMethod->save();
        return response()->json(['success'=>true, 'ShippingMethod'=>$shippingMethod]);
    }
}
