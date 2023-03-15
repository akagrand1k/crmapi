<?php

namespace App\Http\Controllers;

use App\Actions\aGang;
use Illuminate\Http\Request;
use App\Actions\aStudent;

class cStudents extends Controller
{
    public function all(Request $rq, aStudent $aStudent)
    {
        return $aStudent->all($rq->user()->company);
    }

    public function gangs(Request $rq, aStudent $aStudent)
    {
        return $aStudent->gangs(
            $rq->user()->company,
            $rq->input('id', false)
        );
    }

    public function attachGang(Request $rq, aGang $aGang)
    {
        return $aGang->tachSubject(
            'attach',
            $rq->user()->company,
            $rq->input('child_id', false),
            $rq->input('parent_id', false)
        );
    }

    public function detachGang(Request $rq, aGang $aGang)
    {
        return $aGang->tachSubject(
            'detach',
            $rq->user()->company,
            $rq->input('child_id', false),
            $rq->input('parent_id', false)
        );
    }
}
