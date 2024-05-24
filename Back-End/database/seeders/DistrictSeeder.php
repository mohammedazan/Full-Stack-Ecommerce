<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = array(
            array('id' => '1', 'division_id' => '1', 'name' => 'Casablanca', 'bn_name' => 'كازابلانكا', 'lat' => '33.5731104', 'lon' => '-7.5898434', 'url' => 'www.casablanca.ma'),
            array('id' => '2', 'division_id' => '1', 'name' => 'Rabat', 'bn_name' => 'الرباط', 'lat' => '34.020882', 'lon' => '-6.841650', 'url' => 'www.rabat.ma'),
            array('id' => '3', 'division_id' => '2', 'name' => 'Marrakech', 'bn_name' => 'مراكش', 'lat' => '31.629472', 'lon' => '-7.981084', 'url' => 'www.marrakech.ma'),
            array('id' => '4', 'division_id' => '2', 'name' => 'Fes', 'bn_name' => 'فاس', 'lat' => '34.033333', 'lon' => '-5.000000', 'url' => 'www.fes.ma'),
            array('id' => '5', 'division_id' => '3', 'name' => 'Tangier', 'bn_name' => 'طنجة', 'lat' => '35.759465', 'lon' => '-5.833954', 'url' => 'www.tangier.ma'),
            array('id' => '6', 'division_id' => '3', 'name' => 'Agadir', 'bn_name' => 'أكادير', 'lat' => '30.427755', 'lon' => '-9.598107', 'url' => 'www.agadir.ma'),
            array('id' => '7', 'division_id' => '4', 'name' => 'Meknes', 'bn_name' => 'مكناس', 'lat' => '33.893520', 'lon' => '-5.547280', 'url' => 'www.meknes.ma'),
            array('id' => '8', 'division_id' => '4', 'name' => 'Oujda', 'bn_name' => 'وجدة', 'lat' => '34.681389', 'lon' => '-1.908583', 'url' => 'www.oujda.ma'),
            array('id' => '9', 'division_id' => '5', 'name' => 'Kenitra', 'bn_name' => 'القنيطرة', 'lat' => '34.261027', 'lon' => '-6.570261', 'url' => 'www.kenitra.ma'),
            array('id' => '10', 'division_id' => '5', 'name' => 'Tetouan', 'bn_name' => 'تطوان', 'lat' => '35.578452', 'lon' => '-5.368374', 'url' => 'www.tetouan.ma'),
            array('id' => '11', 'division_id' => '6', 'name' => 'Safi', 'bn_name' => 'آسفي', 'lat' => '32.299390', 'lon' => '-9.237183', 'url' => 'www.safi.ma'),
            array('id' => '12', 'division_id' => '6', 'name' => 'El Jadida', 'bn_name' => 'الجديدة', 'lat' => '33.231039', 'lon' => '-8.500787', 'url' => 'www.eljadida.ma')
        );
        foreach ($districts as $district){
            DB::table('districts')->insert([
                'name' => $district['name'],
                'bn_name' => $district['bn_name'],
                'division_id' => $district['division_id'],
            ]);
        }

    }
}
