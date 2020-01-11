<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as Mongo;

class SensorController extends Controller
{
   public function kayitekle(Request $request)
   {
   	//api key al sensor degerlerini al kaydet
   	//GET https://api.thingspeak.com/update?api_key=AL0UGH211FPWBAZC &field1=
       return response()->json($request->all(),200);
   }

   public function dataadd(Request $request)
   {
   	$api_key = $request->api_key;
   	$field1 = $request->field1;
   	//api key al sensor degerlerini al kaydet
   	//GET https://api.thingspeak.com/update?api_key=AL0UGH211FPWBAZC &field1=
      return response()->json(["api-key"=>$api_key,"field1"=>$field1],200);
   }

   public function mongoConnect(){
      $mongo= new Mongo;
      $connection = $mongo->iot->sensors;
      return $connection->find(["api_key"=>"ABCD"])->toArray();
    }

   public function mongoinsert(Request $request){
      $api_key = $request->api_key;
      $fieldno = $request->fieldno;
      $value = $request->value;
      $date = date("Y-m-d H:i:s");
      $mongo= new Mongo;
      $collection = $mongo->iot->sensors;
      $insertOneResult = $collection->insertOne([
          'api_key' => $api_key,
          'field' => $fieldno,
          'value' => $value,
          'date' => $date,
      ]);
      return $collection->find()->toArray();
    }

   
}
/*
$collection = (new MongoDB\Client)->test->users;
   $insertManyResult = $collection->insertMany([
       [
           'username' => 'admin',
           'email' => 'admin@example.com',
           'name' => 'Admin User',
       ],
       [
           'username' => 'test',
           'email' => 'test@example.com',
           'name' => 'Test User',
       ],
   ]);

   $insertOneResult = $collection->insertOne([
       'username' => 'admin',
       'email' => 'admin@example.com',
       'name' => 'Admin User',
   ]);

*/

