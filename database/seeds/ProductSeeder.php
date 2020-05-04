<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Ду 15',
            'price' => 1250
        ]);
        DB::table('products')->insert([
            'name' => 'Ду 20',
            'price' => 1800
        ]);
        DB::table('products')->insert([
            'name' => 'Ду 35',
            'price' => 2604.50
        ]);
        DB::table('products')->insert([
            'name' => 'Ду 40',
            'price' => 2840
        ]);
        DB::table('products')->insert([
            'name' => 'Ду 100',
            'price' => 3401.30
        ]);
        DB::table('products')->insert([
            'name' => 'Ду 250',
            'price' => 23100.55
        ]);
        DB::table('products')->insert([
            'name' => 'Ду 150',
            'price' => 9408
        ]);
    }
}
