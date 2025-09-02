<?php

namespace App\Console\Commands;

use App\Utils\ModuleUtil;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateDummyBusiness extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pos:dummyBusiness';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a dummy business in the application';

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
     * @return mixed
     */
    public function handle()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '512M');
        DB::beginTransaction();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('SET default_storage_engine=INNODB;');
        Artisan::call('cache:clear');
        Artisan::call('migrate:fresh', ['--path'  => 'database/migrations', '--force' => true,]);
        Artisan::call('module:migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DummyBusinessSeeder','--force' => true, ]);
    
        (new ModuleUtil())->getModuleData('dummy_data');
      
    
    }
    
}
