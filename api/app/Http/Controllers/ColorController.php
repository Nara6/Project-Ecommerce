<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'name'=> 'required',
        ]);
        if ($validator -> fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $color = new Color;
        $color->name = $req->name;
        $color->save();

        return response()->json([
            'color'=> $color,
            'message'=> 'Color have been created successfully.'
        ]);

    }

    public function read(){
        $data = Color::select('*')->get();
        return $data;
    }
}
