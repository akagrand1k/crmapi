<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

use App\Traits\UserToArray;

class cAuth extends Controller
{
    use UserToArray;

    public function signIn(Request $request)
    {
        $credentials = $request->only('phone', 'password');//
        if (Auth::once($credentials)) {
            return $this->json($this->userToArray(Auth::user()));
        }
        //throw new Exception('Неверный номер телефона или пароль');
        return $this->sendError('Неверный номер телефона или пароль', [$credentials], 400);
    }

    public function initByTokens(Request $request)
    {
        $user = $request->user();
        return ($user) ?
            $this->json($this->userToArray($user)) :
            $this->sendError('Неверный токен', [], 401);
    }

    public function Test(Request $request)
    {
        return $this->sendResponse(['msg' => 'ok']);
    }

}
