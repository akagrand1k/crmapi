<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*
		<option value="0" <?=(!$payment['bycard'])?'selected':''?>>Наличными</option>
		<option value="1" <?=($payment['bycard']==1)?'selected':''?>>Терминал</option>
		<option value="2" <?=($payment['bycard']==2)?'selected':''?>>Онлайн</option>
<!-- 				<option value="3" <?=($payment['bycard']==3)?'selected':''?>>Рассрочка</option> -->
		<option value="5" <?=($payment['bycard']==5)?'selected':''?>>На сайте</option>
		<option value="4" <?=($payment['bycard']==4)?'selected':''?>>Из приложения</option>
		<option value="6" <?=($payment['bycard']==6)?'selected':''?>>С карты на карту</option>
		<option value="7" <?=($payment['bycard']==7)?'selected':''?>>На расчетный счет</option>*/

 		DB::table('payment_methods')->insert([
            [
                'caption' => 'Наличными',
                'id' => 1
            ],[
                'caption' => 'Терминал',
                'id' => 2
            ],[
                'caption' => 'Онлайн',
                'id' => 3
            ],[
                'caption' => 'Из приложения',
                'id' => 5
            ],[
                'caption' => 'На сайте',
                'id' => 6                
            ],[
                'caption' => 'С карты на карту',
                'id' => 7
            ],[
                'caption' => 'На расчетный счет',
                'id' => 8
            ],[
                'caption' => 'С баланса',
                'id' => 9
            ]            
        ]);
    }
}
