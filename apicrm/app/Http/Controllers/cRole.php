<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class cRole extends Controller
{
    public function getList(Request $request, Role $roles)
    {
        $list = $roles
            ->whereCompanyId($request->user()->company_id)
            ->whereNotIn('slug', ['owner', 'superadmin'])->get();
        return $this->sendResponse(['roles' => $list]);
    }
}
