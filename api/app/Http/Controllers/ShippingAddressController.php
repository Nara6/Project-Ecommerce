<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Models\ShippingAddress;
class ShippingAddressController extends Controller
{
    public function read(){
        $data = ShippingAddress::select('*')->with('user')->get();
        return $data;
    }

    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'user_id' =>'required',
            'address1' => 'required',
            'city'    => 'required',
            'country' => 'required',
            'postalcode' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>true,'message'=>$validator->errors()], 401);
        }
        $user = new Users;
        if(!$user::find($req->user_id)){
            return response()->json(["success"=>false,"message"=>"Invalid user id"],200);
        }
        $shippingAddress = new ShippingAddress;
        $shippingAddress     -> user_id  = $req->user_id;
        $shippingAddress     -> address1 = $req->address1;
        if(!$shippingAddress::find($req->address1)){
            $shippingAddress -> address2 = null;
        }else{
            $shippingAddress -> address2 = $req->address2;
        }
        $shippingAddress     -> city     = $req->city;
        $shippingAddress     -> country  = $req->country;
        $shippingAddress     -> postalcode   = $req->postalcode;
        
        $shippingAddress->save();
        return response()->json(['success'=>true, 'ShippingAddress'=> $shippingAddress],200);
    }
}
