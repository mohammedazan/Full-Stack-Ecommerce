<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
require_once __DIR__ . './countryList.php';

class StorageController extends Controller
{
    public function countryList(){
        $country_list = countryListData();
        return response()->json($country_list);
    }
    public function divisionList(){
        $division_list= Division::get();
        return response()->json($division_list);
    }
    public function districtList(Request $request){

       $divisionList= District::where('division_id',$request->divisionId)->get();
        return response()->json($divisionList);
    }
}

/*
$b = new StorageController() ;

$b->countryList() ;


for($i=0 ; $i<= 10 ;$i++){
foreach ($b as $x => $y) {
   dd("$x ".$y[$i]." <br>") ;
  }}


