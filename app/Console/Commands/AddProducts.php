<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:add {array_feature*} {--cat=car}'; //cat - category

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавить авто/ноутбук в БД предварительно указав характеристики.
    Характеристики авто: марка, цвет, тип коробки, цена. 
    Характеристики ноутбука: марка, озу, частота процессора, размер экрана, цена.';

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
        $key = $this->option();
        $arr_feature = $this->arguments();

        //$this->info(var_dump($key));
        
        if ($key['cat'] == 'car') {
            if (count($arr_feature['array_feature']) == 4) {

                DB::insert('insert into cars (mark, color, type, price) values (?, ?, ?, ?)', [
                    $arr_feature['array_feature'][1], $arr_feature['array_feature'][1],
                    $arr_feature['array_feature'][2], $arr_feature['array_feature'][3],
                ]);

                $this->line('Запрос на добавление авто прошел успешно');
            } else
                $this->error('Аргументы введены неверно. Характеристики авто: марка, цвет, тип коробки, цена.');
        } elseif ($key['cat'] == 'laptop') {
            if (count($arr_feature['array_feature']) == 5) {
                DB::insert('insert into laptops (mark, RAM, GHz, display, price) values (?, ?, ?, ?, ?)', [
                    $arr_feature['array_feature'][1], $arr_feature['array_feature'][1],
                    $arr_feature['array_feature'][2], $arr_feature['array_feature'][3], $arr_feature['array_feature'][4],
                ]);

                $this->line('Запрос на добавление ноутбука прошел успешно');
            } else
                $this->error('Аргументы введены неверно. Характеристики ноутбука: марка, озу, частота процессора, размер экрана, цена.');
        } else
            $this->error('Ключ введен неверно. Значение ключа может быть "car" или "laptop"');
    }
}
