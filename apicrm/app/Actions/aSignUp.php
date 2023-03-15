<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Company;

use App\Traits\UserToArray;

class aSignUp extends Action
{
    use UserToArray;

    public function handle($company, $user, $roles)
    {
        if(User::isExistByPhoneAndPassword($user['phone'], $user['password'])) {
            abort(500, 'Измените Номер телефона или Пароль.');
        }
        return $this->userToArray(
            in_array('owner', $roles) ?
                (new Company())->createNewWithOwner($company, $user) :
                $company->addUser($user, $roles)
        );
    }

}
