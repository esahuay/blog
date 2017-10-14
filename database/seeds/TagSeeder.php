<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'Primero A'
        ]);

        DB::table('tags')->insert([
            'name' => 'Primero B'
        ]);

        DB::table('tags')->insert([
            'name' => 'Primero C'
        ]);
    }
}
