<?php

namespace App\Actions;

class aFilialSeeds extends Action
{
    public function handle($company, $N)
    {
        $filial = new aFilialCreate();
        $place = new aPlaceCreate();

        for ( $i=0; $i < $N['filials'] ; $i++ ) {
            $newFilial = $filial($company);
            for ( $j=0; $j < $N['places'] ; $j++ ) {
                $newPlace = $place($newFilial);
            }
        }
    }
}
