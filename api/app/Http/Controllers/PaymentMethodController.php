<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function read(){
        return $data = PaymentMethod::select('*')->get();
    }
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'card_number'=> 'required|numeric|digits:16',
            'type'=>        'required',
            'cardholder_name'=> 'required',
            'expired_date'   => 'required',
            'CVV'           => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }
        $paymentMethod = new PaymentMethod;
        $paymentMethod -> card_number     =  $req->card_number;
        $paymentMethod -> type            =  $req->type;
        $paymentMethod -> cardholder_name =  $req->cardholder_name;
        $paymentMethod -> expired_date    =  $req->expired_date;
        $paymentMethod -> CVV             =  $req->CVV;

        // save to db
        $paymentMethod->save();
        return response()->json(['success'=> true, 'paymentMethod'=>$paymentMethod]);
        
    }
}
