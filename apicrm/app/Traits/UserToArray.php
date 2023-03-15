<?php

namespace App\Traits;

trait UserToArray
{
    protected function userToArray($user) : array
    {
        return [
            'user'      => $user->makeVisible('api_token'),
            'company'   => $user->company()->first(),
            'roles'     => $user->roles()->get(),
            'apps'      => $user->apps()->get(),
            'perms'     => $user->perms()->get(),
        ];
    }
}
