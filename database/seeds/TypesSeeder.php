<?php

use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            ['id' => 1, 'name' => 'Electricité', 'unity' => 'kWh'],
            ['id' => 2, 'name' => 'Gaz', 'unity' => 'm&sup3;'],
        ]);
    }
}
