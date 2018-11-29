<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateCar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car:create {array_feature*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавить авто в БД предварительно указав характеристики: марка, цвет, тип, цена';

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
        $arr_feature = $this->arguments();
        $this->info(var_dump($arr_feature));
        DB::insert('insert into cars (mark, color, type, price) values (?, ?, ?, ?)', [
            $arr_feature['array_feature'][1], $arr_feature['array_feature'][1],
            $arr_feature['array_feature'][2], $arr_feature['array_feature'][3] ]);

    }
}
