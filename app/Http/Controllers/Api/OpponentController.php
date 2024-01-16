<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Nationality;
use App\Models\Opponent;
use Illuminate\Http\Request;
use stdClass;
use App\Traits\AppTrait;

class OpponentController extends Controller
{

    // :: use trait
    use AppTrait;





    public function index()
    {


        // 1: get opponents
        $opponents = Opponent::with('nationality', 'branchCity')
            ->where('isActive', true)->get();


        // 2: dependencies
        $nationalities = Nationality::all();
        $branchCities = City::all();



        // :: combine - response
        $combine = new stdClass();
        $combine->opponents = $opponents;
        $combine->nationalities = $nationalities;
        $combine->branchCities = $branchCities;



        return response()->json($combine, 200);



    } // end function









    // ------------------------------------------------------------------------------





    public function store(Request $request)
    {


        // 1: create instance
        $opponent = new Opponent();


        // 1.2: basic
        $opponent->name = $request->name;
        $opponent->nameAr = $request->nameAr;
        $opponent->phone = $request->phone;
        $opponent->email = $request->email;

        $opponent->fax = $request->fax;
        $opponent->information = $request->information;
        $opponent->informationAr = $request->informationAr;


        $opponent->identity = $request->identity;
        $opponent->nationalityId = $request->nationalityId;

        $opponent->address = $request->address;
        $opponent->addressAr = $request->addressAr;
        $opponent->branchCityId = $request->branchCityId;





        // 1.2: upload image
        if ($request->hasFile('image')) {

            $fileName = $this->uploadFile($request, 'image', 'opponents/');
            $opponent->image = $fileName;

        } // end if




        $opponent->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Opponent has been added'], 200);


    } // end function







    // ------------------------------------------------------------------------------





    public function update(Request $request)
    {


        // 1: get instance
        $opponent = Opponent::find($request->id);


        // 1.2: basic
        $opponent->name = $request->name;
        $opponent->nameAr = $request->nameAr;
        $opponent->phone = $request->phone;
        $opponent->email = $request->email;

        $opponent->fax = $request->fax;
        $opponent->information = $request->information;
        $opponent->informationAr = $request->informationAr;


        $opponent->identity = $request->identity;
        $opponent->nationalityId = $request->nationalityId;


        $opponent->address = $request->address;
        $opponent->addressAr = $request->addressAr;
        $opponent->branchCityId = $request->branchCityId;





        // 1.2: upload image
        if ($request->hasFile('image')) {

            $this->deleteFile($opponent->image, 'opponents/');
            $fileName = $this->uploadFile($request, 'image', 'opponents/');
            $opponent->image = $fileName;


        } // end if




        $opponent->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Opponent has been updated'], 200);


    } // end function








    // ------------------------------------------------------------------------------





    public function remove($id)
    {


        // 1: get instance
        $opponent = Opponent::find($id);

        $this->deleteFile($opponent->image, 'opponents/');
        $opponent->delete();



        // :: response
        return response()->json(['status' => true, 'message' => 'Opponent has been removed'], 200);


    } // end function









} // end controller
