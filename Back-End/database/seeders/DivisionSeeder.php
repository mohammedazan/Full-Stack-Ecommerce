<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $divisions = array(
            array('id' => '1','name' => 'Tanger-Tétouan-Al Hoceima','bn_name' => 'Tangier-Tetouan-Al Hoceima','url' => 'www.tangerdiv.gov.ma'),
            array('id' => '2','name' => 'Oriental','bn_name' => 'Eastern','url' => 'www.orientaldiv.gov.ma'),
            array('id' => '3','name' => 'Fès-Meknès','bn_name' => 'Fes-Meknes','url' => 'www.fesdiv.gov.ma'),
            array('id' => '4','name' => 'Rabat-Salé-Kénitra','bn_name' => 'Rabat-Sale-Kenitra','url' => 'www.rabatdiv.gov.ma'),
            array('id' => '5','name' => 'Béni Mellal-Khénifra','bn_name' => 'Beni Mellal-Khenifra','url' => 'www.benidiv.gov.ma'),
            array('id' => '6','name' => 'Casablanca-Settat','bn_name' => 'Casablanca-Settat','url' => 'www.casadiv.gov.ma'),
            array('id' => '7','name' => 'Marrakech-Safi','bn_name' => 'Marrakech-Safi','url' => 'www.marrakediv.gov.ma'),
            array('id' => '8','name' => 'Drâa-Tafilalet','bn_name' => 'Drâa-Tafilalet','url' => 'www.draadiv.gov.ma'),
            array('id' => '9','name' => 'Souss-Massa','bn_name' => 'Souss-Massa','url' => 'www.soussdiv.gov.ma'),
            array('id' => '10','name' => 'Guelmim-Oued Noun','bn_name' => 'Guelmim-Oued Noun','url' => 'www.guelmidiv.gov.ma'),
            array('id' => '11','name' => 'Laâyoune-Sakia El Hamra','bn_name' => 'Laayoune-Sakia El Hamra','url' => 'www.laayounediv.gov.ma'),
            array('id' => '12','name' => 'Dakhla-Oued Ed-Dahab','bn_name' => 'Dakhla-Oued Ed-Dahab','url' => 'www.dakhladiv.gov.ma')
        );

        foreach ($divisions as $division){
            DB::table('divisions')->insert([
                'name' => $division['name'],
                'bn_name' => $division['bn_name'],
            ]);
        }
    }
}
