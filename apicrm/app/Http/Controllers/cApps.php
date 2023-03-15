<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class cApps extends Controller
{
/*
    public function installed(Request $rq)
    {
        return $this->sendResponse(
            rUser::from($rq->user())->apps()
            $rq->user()->apps()->select('slug', 'name')->orderBy('name')->get()
        );
    }
*/
    public function menu(Request $rq, App $apps)
    {
        if($rq->filled('slug') && $rq->filled('menu'))
        {
            $app = $apps->whereSlug($rq->input('slug'))->first();

            if($app)
            {
                $app->users()->updateExistingPivot(
                    $rq->user()->id,
                    ['menu' => $rq->input('menu')]
                );
            }
        }

        return $this->sendResponse([]);
    }
}
