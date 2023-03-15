<?php

namespace App\Actions;

class aPlaceCreate extends Action
{
    private static $count = 1;

    public function handle($filial, $data = false)
    {
        $place = [
            'name' => 'Место '.static::$count++,
            'capacity' => mt_rand(10, 22)
        ];
        if($data) {
            $place = array_merge($place, $data);
        }
        return $filial->places()->create($place);
    }

    public function create(&$filial, $data = false)
    {
        $place = [
            'name' => 'Место '.static::$count++,
            'capacity' => mt_rand(10, 22)
        ];
        if($data) {
            $place = array_merge($place, $data);
        }
        return $filial->places()->create($place);
    }
}
