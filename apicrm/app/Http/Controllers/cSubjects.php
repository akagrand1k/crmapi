<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\aGang;
use App\Actions\aSubject;
use App\Actions\aTeacher;

class cSubjects extends Controller
{
    public function all(Request $rq, aSubject $aSubject)
    {
        return $aSubject->all($rq->user()->company);
    }

    public function create(Request $rq, aSubject $aSubject)
    {
        return $aSubject->create($rq->user()->company);
    }

    public function patch(Request $rq, aSubject $aSubject)
    {
        return $aSubject->patch(
            $rq->user()->company,
            $rq->input('id'),
            $rq->input('data')
        );
    }

    public function delete(Request $rq, aSubject $aSubject)
    {
        // TODO Add Request validation
        return $aSubject->delete($rq->user()->company, $rq->input('id'));
    }

    public function teachers(Request $rq, aSubject $aSubject)
    {
        return $aSubject->teachers(
            $rq->user()->company,
            $rq->input('id', false)
        );
    }

    public function attachTeacher(Request $rq, aTeacher $aTeacher)
    {
        return $aTeacher->tachSubject(
            'attach',
            $rq->user()->company,
            $rq->input('child_id', false),
            $rq->input('parent_id', false)
        );
    }

    public function detachTeacher(Request $rq, aTeacher $aTeacher)
    {
        return $aTeacher->tachSubject(
            'detach',
            $rq->user()->company,
            $rq->input('child_id', false),
            $rq->input('parent_id', false)
        );
    }

    public function gangs(Request $rq, aSubject $aSubject)
    {
        return $aSubject->gangs(
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
