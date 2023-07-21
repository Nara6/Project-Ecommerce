<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Models\BillingAddress;

class BillingAddressController extends Controller
{
    public function read(){
        $data = BillingAddress::select('*')->with('user')->get();
        return $data;
    }

    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'user_id' =>'required',
            'address' => 'required',
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
        $billingAddress = new BillingAddress;
        $billingAddress     -> user_id = $req->user_id;
        $billingAddress     -> address = $req->address;
        $billingAddress     -> city    = $req->city;
        $billingAddress     -> country = $req->country;
        $billingAddress     -> postalcode   = $req->postalcode;
        
        $billingAddress->save();
        return response()->json(['success'=>true, 'BillingAddress'=> $billingAddress],200);
    }

}
