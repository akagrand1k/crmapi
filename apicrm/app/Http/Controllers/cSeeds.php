<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Actions\aSeeds;

class cSeeds extends Controller
{
    public function run()
    {
        return aSeeds::run();
    }

    public function test1()
    {
        throw new HttpException(403, 'Измените Номер телефона или Пароль.');
    }
    public function test2()
    {
        abort(422, 'Измените Номер телефона или Пароль.');
    }
}
