<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
         //DB::table('company_infos')->delete();
        DB::table('company_infos')->insert([
            'name' => 'ForBest',
            'email' => 'ForBest@example.com',
            'phone' => '123-456-7890',
            'company_logo' => 'default_logo.jpg', // Example default logo file
            'facebook_link' => 'https://www.facebook.com/example',
            'youtube_link' => 'https://www.youtube.com/example',
            'twitter_link' => 'https://twitter.com/example',
            'company_address' => 'Your Company Address',
            'about_us' => 'About Your Company',
            'refund_policy' => 'Your Refund Policy',
            'privacy_policy' => 'Your Privacy Policy',
            'shipping_policy' => 'Your Shipping Policy',
            'terms_condition' => 'Your Terms and Conditions',
            'created_at' => now(),
            'created_by' => 'Seeder',
            'updated_at' => now(),
            'updated_by' => 'Seeder',
            'deleted' => 'No',
            'deleted_at' => null,
            'deleted_by' => null,
        ]);
    }
}
