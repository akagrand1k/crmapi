<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use Illuminate\Support\Facades\DB;

use App\Actions\aSeeds;

class DbClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:db:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset DB for current connection and run all Migrations and Seeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm(
            'CONFIRM'.PHP_EOL.
            '- Drop all Tables'.PHP_EOL.
            '- Run all Migrations'.PHP_EOL.
            '- Apply all Seeds'.PHP_EOL.
            '- Generate Company with Users'.PHP_EOL
        )) {
            //exit('Drop Tables command aborted');
            $this->line(PHP_EOL.'<fg=blue>RESET DB</>'.PHP_EOL);
            $this->call('db:wipe');

            $this->line(PHP_EOL.'<fg=blue>MIGRATIONS</>'.PHP_EOL);
            $this->call('migrate');

            // $timer = now();
            $this->line(PHP_EOL.'<fg=blue>SEEDS</>'.PHP_EOL);
            $this->call('db:seed');
            // $this->line($timer->diffInSeconds(now()).' sec');

            $this->line(PHP_EOL.'<fg=blue>COMPANY FACTORY</>'.PHP_EOL);
            for ($i=0; $i < 2; $i++) {
                $log = aSeeds::run();
                $this->line(implode(PHP_EOL,
                    array_map( function($k, $v){
                        return $v == '' ? (is_numeric($k) ? '' : $k) :
                               (is_numeric($k) ? "<fg=magenta>$v</>" : ($k == 'h2' ? "<fg=blue>$v</>" : "$k: <fg=magenta>$v</>"));
                    }, array_keys($log), array_values($log))
                ).PHP_EOL);
            }

        }
/*
        $tables = array_map('reset', \DB::select('SHOW TABLES'));
        if(count($tables) > 0)
        {
            $droplist = implode(',', $tables);
            $this->comment(PHP_EOL . "Table List: " . $droplist . PHP_EOL);

            DB::beginTransaction();
            //turn off referential integrity
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $droplist");
            //turn referential integrity back on
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();
        }
*/


        // $this->comment(PHP_EOL . "If no errors showed up, all tables were dropped" . PHP_EOL);
    }
}
