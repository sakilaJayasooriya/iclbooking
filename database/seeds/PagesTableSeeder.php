<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();

        DB::table('pages')->insert([
        	['name' => 'Help', 'url' => 'help', 'status' => 'Active', 'content' => 'Help page coming soon.'],
        ]);
    }
}
