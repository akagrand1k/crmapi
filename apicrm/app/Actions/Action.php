<?php

namespace App\Actions;

abstract class Action
{
    // abstract public function handle();

    public static function run(...$arguments) {
        return (new static())->handle(...array_values($arguments));
    }

    public function __invoke(...$arguments)
    {
        return $this->handle(...array_values($arguments));
    }
}
