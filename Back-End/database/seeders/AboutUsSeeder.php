<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
         //DB::table('company_infos')->delete();
        DB::table('about_us')->insert([
            'title' => 'About Our Company',
            'history' => 'We have been in business for over 50 years...',
            'mission' => 'Our mission is to provide the best service...',
            'vision' => 'We aim to be the global leader in...',
            'values' => 'Integrity, Excellence, Innovation...',
            'additional_info' => 'Additional information about our company...',
        ]);
    }
}
