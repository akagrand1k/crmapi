<?php

namespace App\Actions;

//use App\Models\App;

use App\Traits\UserToArray;

class aTest extends Action
{
    use UserToArray;

    public function handle($msg)
    {
        return ['msg' => $msg];
    }
}
