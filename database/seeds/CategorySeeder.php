<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Publico'
        ]);
        DB::table('categories')->insert([
            'name' => 'Privado'
        ]);
    }
}
