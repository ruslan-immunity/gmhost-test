<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:delete {id} {--cat=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удалить товар указав в аргументе id и выбрав при помощи ключа "cat" категорию.';

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
        $argument = $this->argument();

        //$this->info(var_dump($argument['id']));

        if ($key['cat'] == 'car') {

            DB::delete('DELETE FROM cars WHERE id = :id', ['id' => $argument['id']]);

            $this->line('Удален автомобиль под id ' . $argument['id']);

        } elseif ($key['cat'] == 'laptop') {

            DB::delete('DELETE FROM laptops WHERE id = :id', ['id' => $argument['id']]);

            $this->line('Удален ноутбук под id ' . $argument['id']);

        } else
            $this->error('Ключ введен неверно. Значение ключа может быть "car" или "laptop"');
    }
}
