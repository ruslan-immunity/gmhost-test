<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowLastProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:show-last {cat}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Показать N последних добавленных товаров (учитывать обе категории)';

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
        $argument = $this->argument();
        $first = DB::table('laptops')->select('created_at');

        //$this->line($argument);

        $all = DB::table('cars')->select('created_at')
            ->union($first)
            ->orderBy('created_at','desc')
            ->take($argument)
            ->get();

        if (var_dump($all) != NULL)
            $this->line(var_dump($all));

        $this->info('Запрос прошел успешно');
        
        
    }
}
