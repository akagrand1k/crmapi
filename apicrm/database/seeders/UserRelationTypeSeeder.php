<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserRelationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_relation_types')->insert([
            [
                'slug' => 'mother',
                'caption' => 'Мама',
            ],[
                'slug' => 'father',
                'caption' => 'Папа',
            ],[
                'slug' => 'grandmother',
                'caption' => 'Бабушка',
            ],[
                'slug' => 'grandfather',
                'caption' => 'Дедушка',
            ],[
                'slug' => 'brother',
                'caption' => 'Брат',
            ],[
                'slug' => 'sister',
                'caption' => 'Сестра',
            ],[
                'slug' => 'son',
                'caption' => 'Сын',
            ],[
                'slug' => 'daughter',
                'caption' => 'Дочь',
            ],[
                'slug' => 'grandson',
                'caption' => 'Внук',
            ],[
                'slug' => 'granddaughter',
                'caption' => 'Внучка',
            ]
        ]);
    }
}
