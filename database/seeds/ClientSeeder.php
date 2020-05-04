<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => 'ООО Символ'
        ]);
        DB::table('clients')->insert([
            'name' => 'ООО Ласточка'
        ]);
        DB::table('clients')->insert([
            'name' => 'ООО Шанс'
        ]);
        DB::table('clients')->insert([
            'name' => 'ООО Газстрой'
        ]);
        DB::table('clients')->insert([
            'name' => 'ООО СтройГаз'
        ]);
        DB::table('clients')->insert([
            'name' => 'ООО Олег'
        ]);
    }
}
