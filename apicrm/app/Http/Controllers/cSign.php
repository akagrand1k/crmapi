<?php

namespace App\Http\Controllers;

use App\Http\Requests\frSignUp;
use App\Actions\aUserSeeds;
use App\Actions\aSignUp;

class cSign extends Controller
{
    protected $userFields = ['firstname', 'middlename', 'lastname', 'birthday', 'gender', 'phone', 'email', 'password'];

    public function up(frSignUp $rq, aSignUp $sign)
    {
        //return $rq->all();
        $roles = $rq->input('roles', ['student']);
        $roles = count($roles) ? $roles : ['student'];

        return $sign(
            in_array('owner', $roles) ?
                ['name' => 'Компания '.$rq->input('lastname')] :
                $rq->user()->company,
            $rq->only($this->userFields),
            $roles
        );
    }

    public function fake(aUserSeeds $seeds)
    {
        return $seeds->user();
    }
    /*
    return $this->sendResponse([
            'ajax()'    => $rq->ajax(),
            'wantsJson()' => $rq->wantsJson(), // true
        ]);
    */
}
