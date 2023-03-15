<?php

namespace App\Actions;

//use Faker\Generator as Faker;
use Faker\Factory as Faker;

class aUserSeeds extends Action
{
    private $phone;
    private $f;

    public function __construct() {
        $this->phone = mt_rand(10, 90) * 100;
        $this->f = Faker::create(config('faker_locale', 'ru_RU'));
    }

    public function handle($company = NULL, $roles = NULL)
    {
        $users = [];
        $sign = new aSignUp();

        if(!$company) {
            $owner = $sign(['name' => 'Школа '.$this->phone++], $this->user(), ['owner']);
            if(!$roles) {
                return $owner;
            }
            $company = $owner['company'];
        }
        //$roles = ['student'=> 10, 'teacher' => 3, 'teacher,admin' => 2, 'saleman' => 1];
        foreach ( $roles as $role => $count ) {
            $users[$role] = [];
            for ( $i=0; $i < $count; $i++ ) {
                $users[$role][] = $sign($company, $this->user(), explode(',', $role));
            }
        }

        return $users;
    }

    public function user()
    {
        $sexRu = ['male' => 'мужской', 'female' => 'женский'];
        $sex = mt_rand(0,1) ? 'male' : 'female';
        return [
            'firstname' => $this->f->firstName($sex),
            'middlename' => $this->f->middlename($sex),
            'lastname' => $this->f->lastName($sex),
            'phone' => $this->phone++,
            'email' => $this->f->email,
            'password' => '123456',
            'gender' => $sexRu[$sex],
            'birthday' => $this->f->dateTimeBetween($startDate = '-30 years', $interval = '-10 years')->format("Y-m-d")
            //
        ];
    }
}
