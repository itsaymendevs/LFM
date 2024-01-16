<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpertOffice;
use Illuminate\Http\Request;
use stdClass;

class ExpertOfficeController extends Controller
{


    public function index()
    {


        // 1: get expertOffices
        $expertOffices = ExpertOffice::all();



        // :: combine - response
        $combine = new stdClass();
        $combine->expertOffices = $expertOffices;


        return response()->json($combine, 200);



    } // end function









    // ------------------------------------------------------------------------------





    public function store(Request $request)
    {


        // 1: create instance
        $expertOffice = new ExpertOffice();


        // 1.2: basic
        $expertOffice->name = $request->name;
        $expertOffice->nameAr = $request->nameAr;
        $expertOffice->phone = $request->phone;
        $expertOffice->email = $request->email;

        $expertOffice->contactPerson = $request->contactPerson;
        $expertOffice->contactPersonAr = $request->contactPersonAr;
        $expertOffice->contactPersonPhone = $request->contactPersonPhone;


        $expertOffice->address = $request->address;
        $expertOffice->addressAr = $request->addressAr;



        $expertOffice->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Office has been added'], 200);


    } // end function







    // ------------------------------------------------------------------------------





    public function update(Request $request)
    {


        // 1: get instance
        $expertOffice = ExpertOffice::find($request->id);


        // 1.2: basic
        $expertOffice->name = $request->name;
        $expertOffice->nameAr = $request->nameAr;
        $expertOffice->phone = $request->phone;
        $expertOffice->email = $request->email;

        $expertOffice->contactPerson = $request->contactPerson;
        $expertOffice->contactPersonAr = $request->contactPersonAr;
        $expertOffice->contactPersonPhone = $request->contactPersonPhone;


        $expertOffice->address = $request->address;
        $expertOffice->addressAr = $request->addressAr;



        $expertOffice->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Office has been updated'], 200);


    } // end function








    // ------------------------------------------------------------------------------





    public function remove($id)
    {


        // 1: get instance
        $expertOffice = ExpertOffice::find($id);
        $expertOffice->delete();



        // :: response
        return response()->json(['status' => true, 'message' => 'Office has been removed'], 200);


    } // end function






} // end controller
