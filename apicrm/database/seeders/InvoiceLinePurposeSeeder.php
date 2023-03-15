<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InvoiceLinePurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('invoce_line_purposes')->insert([
            [
                'caption' => 'Оплата за обучение'
            ],[
                'caption' => 'Выплата сотруднику'
            ],[
                'caption' => 'Аванс сотруднику'
            ],[
                'caption' => 'Бонус сотруднику'
            ],[
                'caption' => 'Текущие расходы'
            ]
        ]);
    }
}
