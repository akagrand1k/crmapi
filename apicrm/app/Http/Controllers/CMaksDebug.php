<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filial;

class CMaksDebug extends Controller
{
    public function Test(Request $request){
        $company_id = $request->company_id;
        $filials = Filial::where('company_id',$company_id)->get();

        return $filials;
    }
}
