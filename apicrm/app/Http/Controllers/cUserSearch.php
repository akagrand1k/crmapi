<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CoreRequest;
use App\Models\Role;
use App\Models\User;

class cUserSearch extends Controller
{
    public function getList(Request $request, User $user, Role $role)
    {
        $roles = $request->input('data.roles', []);

        $num = $request->input('rowsPerPage', 3);

        // $query = $role->whereSlug($slug)->first()->usersByCompany($request->identity()->company_id);
        $query = count($roles) > 0 ?
            $request->user()->searchByRoles($roles) :
            $request->user()->query();

        $dbg_query = $query->toSql();

        if( $request->filled('filter') )
        {
            $filter = $request->input('filter');
            $query = $query->whereRaw( 'LOWER(CONCAT(`firstname`, " ", `lastname`, " ", `phone`, " ", `email`)) like ?', array('%'.$filter.'%') );
        }

        $sortDefault = 'name';
        $sort = [
            'name' => 'concat(lastname, " ", firstname)',
            'phone' => 'phone',
            'email' => 'email'
        ];

        if( $request->filled('sortBy') )
        {
            $col = $sort[$request->input('sortBy')] ?? $sort[$sortDefault];
            $desc = $request->input('descending', false) ? ' DESC' : '';
            $query = $query->orderByRaw($col.$desc);
        }

        $result = $query->paginate($num, ['*']); //$query->paginate($num, ['*']);
        //$dbg = $query;

        $list = $result->toArray();

        return $this->sendResponse([
            'users' => $list['data'],
            'page' => $list['current_page'],
            'total' => $list['total'],
            //'debug' => $dbg,
            //'debug_query' => $dbg_query
        ]);
    }
}
