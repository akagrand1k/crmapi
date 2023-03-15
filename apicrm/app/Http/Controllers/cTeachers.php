<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\aTeacher;

class cTeachers extends Controller
{
    public function all(Request $rq, aTeacher $aTeacher)
    {
        return $aTeacher->all($rq->user()->company);
    }

    public function subjects(Request $rq, aTeacher $aTeacher)
    {
        return $aTeacher->subjects(
            $rq->user()->company,
            $rq->input('id', false)
        );
    }

    public function attachSubject(Request $rq, aTeacher $aTeacher)
    {
        return $aTeacher->tachSubject(
            'attach',
            $rq->user()->company,
            $rq->input('parent_id', false),
            $rq->input('child_id', false)
        );
    }

    public function detachSubject(Request $rq, aTeacher $aTeacher)
    {
        return $aTeacher->tachSubject(
            'detach',
            $rq->user()->company,
            $rq->input('parent_id', false),
            $rq->input('child_id', false)
        );
    }
}
