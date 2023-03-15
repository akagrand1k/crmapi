<?php

namespace App\Repositories;

use App\Models\App;

class rApp
{
    private $apps;

    public function __construct() {
        $this->apps = new App();
    }

    public static function get(): self
    {
        return new self(); // new static($user)
    }

    public function getFirstBySlug($slug)
    {
        return $this->apps->whereSlug()->first()->toArray();
    }
}
