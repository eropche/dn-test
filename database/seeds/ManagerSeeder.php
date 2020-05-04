<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'name' => 'Яна',
            'patronymic' => 'Дмитриевна',
            'surname' => 'Крестова'
        ]);
        DB::table('managers')->insert([
            'name' => 'Глеб',
            'patronymic' => 'Иванович',
            'surname' => 'Иванов'
        ]);
        DB::table('managers')->insert([
            'name' => 'Сергей',
            'patronymic' => 'Игоревич',
            'surname' => 'Павлов'
        ]);
    }
}
