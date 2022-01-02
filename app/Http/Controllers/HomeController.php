<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;
use DateTime;
class HomeController extends Controller
{
    public $success_status = 200;
    public function submit(request $request){
     
        if(isset($request['brith']) && isset($request['gender'])){
            $faker = Faker::create('pl_PL');
            $pesel = $faker->pesel(new \DateTime($request['brith']),$request['gender']); 
            $faker = Faker::create('nl_NL');
            $svn = $faker->idNumber(new \DateTime($request['brith']),$request['gender']); 
            $faker = Faker::create('de_AT');
            $bsn = $faker->ssn(new \DateTime($request['brith']),$request['gender']); 
        }else{
            $faker = Faker::create('pl_PL');
            $pesel = $faker->pesel(); 
            $faker = Faker::create('nl_NL');
            $svn = $faker->idNumber(); 
            $faker = Faker::create('de_AT');
            $bsn = $faker->ssn(); 
        }
        return response()->json(['pesel'=>$pesel,'svn'=>$svn,'bsn'=>$bsn],$this->success_status);
    }
}