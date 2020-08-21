<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->truncate();

        DB::table('banners')->insert([
        		['heading' => 'Welcome to Hotel', 'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'image' => 'banner_1.jpg'],
        		['heading' => 'Feel Like Your Home', 'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'image' => 'banner_2.jpg'],
        		['heading' => 'Perfect Place for Dining', 'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'image' => 'banner_3.jpg'],
        	]);
    }
}
