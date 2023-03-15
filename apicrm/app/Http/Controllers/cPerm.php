<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Role;

class cPerm extends Controller
{
    public function getList(Request $rq, App $app, Role $role)
    {
        $apps  = $app->select('id','slug','name')
                    ->with('perms:id,app_id,slug,name')->get();

        $roles = $role->select('id','slug','name')
                    ->whereCompanyId($rq->user()->company_id)
                    ->whereNotIn('slug', ['owner','superadmin'])
                    ->with('perms:id,app_id,slug,name')->get();

        return $this->sendResponse(['apps'=>$apps, 'roles'=>$roles]);
    }

    public function sync(Request $rq, Role $roles)
    {
        $perm  = $rq->user()
                    ->apps()->whereSlug($rq->input('app'))->first()
                    ->perms()->whereSlug($rq->input('perm'))->first();

        if($rq->filled('role') && $rq->filled('val'))
        {
            $role = $roles->whereCompanyId($rq->user()->company_id)
                          ->whereSlug($rq->input('role'))->first()->perms();

            $rq->input('val') ? $role->attach($perm->id) : $role->detach($perm->id);
        }

        return $this->sendResponse([]);
    }
}
