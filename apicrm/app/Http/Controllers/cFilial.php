<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filial;
use App\Actions\aFilialCreate;

class cFilial extends Controller
{
    public function getList(Request $rq, aFilial $Filial){

        //return $Filial->all($rq->user()->company);

        return $rq->user()->company->filials()->with('places')->orderBy('id','desc')->get();
    }

    public function create(Request $rq, aFilialCreate $Filial){

        // return $Filial($rq->user()->company, ['name' => 'Новый филиал']);
        return $Filial->createWithPlace($rq->user()->company, ['name' => 'Новый филиал']);
    }

    public function delete(Request $request){
        $result = Filial::where('id',$request->filial_id)->delete();

        return $result;
    }

    public function patch(Request $request){
        $id = $request->id;
        $name = $request->value;
        $result = Filial::where('id',$id)->update(['name'=>$name]);

        return $result;
    }
}
