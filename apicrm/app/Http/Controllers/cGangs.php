<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\aGang;

class cGangs extends Controller
{
    public function all(Request $rq, aGang $aGang)
    {
        return $aGang->all($rq->user()->company);
    }

    public function create(Request $rq, aGang $aGang)
    {
        return $aGang->create($rq->user()->company);
    }

    public function patch(Request $rq, aGang $aGang)
    {
        return $aGang->patch(
            $rq->user()->company,
            $rq->input('id'),
            $rq->input('new')
        );
    }

    public function delete(Request $rq, aGang $aGang)
    {
        // TODO Add Request validation
        return $aGang->delete($rq->user()->company, $rq->input('id'));
    }

    public function students(Request $rq, aGang $aGang)
    {
        return $aGang->students(
            $rq->user()->company,
            $rq->input('id', false)
        );
    }

    public function attachStudent(Request $rq, aGang $aGang)
    {
        return $aGang->tachStudent(
            'attach',
            $rq->user()->company,
            $rq->input('parent_id', false),
            $rq->input('child_id', false)
        );
    }

    public function detachStudent(Request $rq, aGang $aGang)
    {
        return $aGang->tachStudent(
            'detach',
            $rq->user()->company,
            $rq->input('parent_id', false),
            $rq->input('child_id', false)
        );
    }

    public function subjects(Request $rq, aGang $aGang)
    {
        return $aGang->subjects(
            $rq->user()->company,
            $rq->input('id', false)
        );
    }

    public function attachSubject(Request $rq, aGang $aGang)
    {
        return $aGang->tachSubject(
            'attach',
            $rq->user()->company,
            $rq->input('parent_id', false),
            $rq->input('child_id', false)
        );
    }

    public function detachSubject(Request $rq, aGang $aGang)
    {
        return $aGang->tachSubject(
            'detach',
            $rq->user()->company,
            $rq->input('parent_id', false),
            $rq->input('child_id', false)
        );
    }
}
