<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\File;
use Illuminate\Http\Request;
use stdClass;

class FileController extends Controller
{




    public function index()
    {


        // 1: get files
        $files = File::with('branchCity', 'client', 'cases', 'associatedCases')->get();


        // 2: dependencies
        $clients = Client::all();
        $branchCities = City::all();



        // :: combine - response
        $combine = new stdClass();
        $combine->files = $files;
        $combine->clients = $clients;
        $combine->branchCities = $branchCities;



        return response()->json($combine, 200);



    } // end function









    // ------------------------------------------------------------------------------





    public function store(Request $request)
    {


        // 1: create instance
        $file = new File();


        // 1.2: basic
        $file->serial = $request->serial;
        $file->clientId = $request->clientId;
        $file->officeFees = $request->officeFees;
        $file->creationDate = $request->creationDate;

        $file->information = $request->information;
        $file->informationAr = $request->informationAr;
        $file->branchCityId = $request->branchCityId;

        $file->creatorId = $request->creatorId;



        $file->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'File has been added'], 200);


    } // end function







    // ------------------------------------------------------------------------------





    public function update(Request $request)
    {


        // 1: get instance
        $file = File::find($request->id);


        // 1.2: basic
        $file->officeFees = $request->officeFees;

        $file->information = $request->information;
        $file->informationAr = $request->informationAr;
        $file->branchCityId = $request->branchCityId;


        $file->save();






        // :: response
        return response()->json(['status' => true, 'message' => 'File has been updated'], 200);


    } // end function








    // ------------------------------------------------------------------------------





    public function remove($id)
    {


        // 1: get instance
        $file = File::find($id);
        $file->delete();



        // :: response
        return response()->json(['status' => true, 'message' => 'File has been removed'], 200);


    } // end function







} // end controller
