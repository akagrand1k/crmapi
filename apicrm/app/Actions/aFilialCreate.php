<?php

namespace App\Actions;

use App\Models\Filial;

class aFilialCreate extends Action
{
    protected static $count = 1;

    public function handle($company, $filial = '')
    {
        return $this->create($company, $filial);
        // return $this->createWithPlace($company, $filial, $place);
        /*
        $def = ['name' => 'Филиал '.static::$count++];
        $filial = $company->filials()->create(
            $filial == '' ? $def : array_merge($def, $filial)
        );
        $filial->places()->create(['name'=> 'Новый кабинет']);
        // return $company->filials->where('id',$filial->id)->places();
        return Filial::find($filial->id)->with('places');*/
    }

    public function create($company, $filial = '')
    {
        $def = ['name' => 'Филиал '.static::$count++];
        $filial = $company->filials()->create(
            $filial == '' ? $def : array_merge($def, $filial)
        );
        return $filial;
        // return $company->filials->where('id',$filial->id)->places();
        // return Filial::find($filial->id)->with('places');
    }

    public function createWithPlace($company, $filial = '', $place = '')
    {
        $filial = $this->create($company, $filial);
        aPlaceCreate::run( $filial, $place );
        return $filial;
    }
}
