<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:show {cat*} {--sort=desc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Показать все товары из указанной категории, сортировка товаров по полю.';

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
     * @param $arguments
     * @param $keys
     * @param $arr_fields
     * @return mixed
     * @internal param $argument
     */

    public function send_select_query($arguments, $keys, $arr_fields)
    {
        if (in_array($arguments['cat'][1], $arr_fields)) {
            if ($keys['sort'] == 'asc' || $keys['sort'] == 'desc' || $keys['sort'] == '') {
                $query = DB::select('SELECT * FROM '. $arguments['cat'][0] .' ORDER BY '. $arguments['cat'][1]. ' '.
                    $keys['sort']);

                if (var_dump($query) != NULL)
                    $this->line(var_dump($query));

                $this->info('Запрос прошел успешно');
            }
        }
    }


    public function handle()
    {
        $keys = $this->option();
        $arguments = $this->arguments();
        
        $arr_fields_laptop = ['id', 'mark', 'RAM', 'GHz', 'display', 'price'];
        $arr_fields_car = ['id', 'mark', 'color', 'type', 'price'];

        if ($arguments['cat'][0] == 'laptops')
            $this->send_select_query($arguments, $keys, $arr_fields_laptop);
        elseif ($arguments['cat'][0] == 'cars')
            $this->send_select_query($arguments, $keys, $arr_fields_car);
        else
            $this->error('Аргумент введен неверно. Значение аргумента может быть "cars" или "laptops"');

    }
}
