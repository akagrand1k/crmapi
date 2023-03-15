<?php

namespace App\Repositories;

use App\Models\App;

class rUser
{
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public static function from($user): self
    {
        return new self($user); // new static($user)
    }

    public function apps()
    {
        return $this->user->apps()->orderBy('name')->get()->toArray();
    }

    public function showAppInMenu()
    {
        $app = $apps->whereSlug($rq->input('slug'))->first();

        if($app)
        {
            $app->users()->updateExistingPivot(
                $rq->user()->id,
                ['menu' => $rq->input('menu')]
            );
        }
    }
}
