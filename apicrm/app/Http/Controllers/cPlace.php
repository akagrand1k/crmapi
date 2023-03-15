<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class cPlace extends Controller
{
    public function create(Request $request){
        $Place = new Place();
        $Place->name = 'Новый кабинет';
        $Place->filial_id = $request->filial_id;
        $Place->save();

        return $Place;
    }

    public function delete(Request $request){
        $result = Place::where('id',$request->id)->delete();

        return $result;
    }

    public function patch(Request $request){
        $id = $request->id;
        $name = $request->value;
        $result = Place::where('id',$id)->update(['name'=>$name]);

        return $result;
    }
}
