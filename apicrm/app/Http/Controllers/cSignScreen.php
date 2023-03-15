<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cSignScreen extends Controller
{
    public function getList(Request $request)
    {
        $list = $roles
            ->whereCompanyId($request->user()->company_id)
            ->whereNotIn('slug', ['owner', 'superadmin'])->get();
        return $this->sendResponse(['roles' => $list]);
    }
}
