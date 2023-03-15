<?php

namespace App\Actions;

//use App\Models\Filial;

class aGangSeeds extends Action
{
    protected static $count = 1;

    public function handle($company, $gangsNum = 5)
    {
        return $this->few($company, $gangsNum);
    }

    public function create($company, $gang = '')
    {
        $def = ['name' => 'Группа '.static::$count++];

        return $company->gangs()->create(
            $gang == '' ? $def : array_merge($def, $gang)
        );
    }

    public function few($company, $gangsNum = 5) {
        $gangs = [];
        for ($i=0; $i < $gangsNum; $i++){
            $gangs[] = $this->create($company);
        }
        return $gangs;
    }
}
