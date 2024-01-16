<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientAttachment;
use App\Models\ClientContract;
use App\Models\ClientType;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;
use App\Traits\AppTrait;

class ClientController extends Controller
{

    // :: use trait
    use AppTrait;




    public function index()
    {


        // 1: get clients
        $clients = Client::with('clientType', 'nationality', 'branchCity')
            ->where('isActive', true)->get();


        // 2: dependencies
        $clientTypes = ClientType::all();
        $nationalities = Nationality::all();
        $branchCities = City::all();



        // :: combine - response
        $combine = new stdClass();
        $combine->clients = $clients;
        $combine->clientTypes = $clientTypes;
        $combine->nationalities = $nationalities;
        $combine->branchCities = $branchCities;



        return response()->json($combine, 200);



    } // end function









    // ------------------------------------------------------------------------------





    public function store(Request $request)
    {


        // 1: create instance
        $client = new Client();


        // 1.2: basic
        $client->name = $request->name;
        $client->nameAr = $request->nameAr;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->personalEmail = $request->personalEmail;
        $client->password = Hash::make($request->password);

        $client->fax = $request->fax;
        $client->mailBox = $request->mailBox;
        $client->information = $request->information;
        $client->informationAr = $request->informationAr;


        $client->identity = $request->identity;
        $client->clientTypeId = $request->clientTypeId;
        $client->nationalityId = $request->nationalityId;


        $client->address = $request->address;
        $client->addressAr = $request->addressAr;
        $client->branchCityId = $request->branchCityId;





        // 1.2: upload image
        if ($request->hasFile('image')) {

            $fileName = $this->uploadFile($request, 'image', 'clients/');
            $client->image = $fileName;

        } // end if




        $client->save();





        // -----------------------------
        // -----------------------------


        // 2: create attachment placeholders
        $attachmentTypes = ['WORK LICENSE', 'IDENTITY', 'IDENTITY 2', 'IDENTITY 3'];


        foreach ($attachmentTypes as $attachmentType) {

            $clientAttachment = new ClientAttachment();

            $clientAttachment->type = $attachmentType;
            $clientAttachment->clientId = $client->id;

            $clientAttachment->save();

        } // end loop










        // :: response
        return response()->json(['status' => true, 'message' => 'Client has been added'], 200);


    } // end function







    // ------------------------------------------------------------------------------





    public function update(Request $request)
    {


        // 1: get instance
        $client = Client::find($request->id);


        // 1.2: basic
        $client->name = $request->name;
        $client->nameAr = $request->nameAr;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->personalEmail = $request->personalEmail;
        $client->password = Hash::make($request->password);

        $client->fax = $request->fax;
        $client->mailBox = $request->mailBox;
        $client->information = $request->information;
        $client->informationAr = $request->informationAr;


        $client->identity = $request->identity;
        $client->clientTypeId = $request->clientTypeId;
        $client->nationalityId = $request->nationalityId;


        $client->address = $request->address;
        $client->addressAr = $request->addressAr;
        $client->branchCityId = $request->branchCityId;





        // 1.2: upload image
        if ($request->hasFile('image')) {

            $this->deleteFile($client->image, 'clients/');
            $fileName = $this->uploadFile($request, 'image', 'clients/');
            $client->image = $fileName;


        } // end if




        $client->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Client has been updated'], 200);


    } // end function








    // ------------------------------------------------------------------------------





    public function remove($id)
    {


        // 1: get instance
        $client = Client::find($id);

        $this->deleteFile($client->image, 'clients/');
        $client->delete();



        // :: response
        return response()->json(['status' => true, 'message' => 'Client has been removed'], 200);


    } // end function





















    // ------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------










    public function updateAttachment(Request $request, $clientId)
    {


        // 1: get instance
        $clientAttachment = ClientAttachment::find($request->id);


        $clientAttachment->fromDate = $request->fromDate;
        $clientAttachment->untilDate = $request->untilDate;



        // 1.2: upload image
        if ($request->hasFile('image')) {

            $this->deleteFile($clientAttachment->image, 'clients/attachments/');
            $fileName = $this->uploadFile($request, 'image', 'clients/attachments/');
            $clientAttachment->image = $fileName;


        } // end if




        $clientAttachment->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Attachment has been updated'], 200);


    } // end function







    // ------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------







    public function storeContract(Request $request, $clientId)
    {



        // 1: create instance
        $contract = new ClientContract();



        // 1.2: general
        $contract->name = $request->name;
        $contract->nameAr = $request->nameAr;
        $contract->phone = $request->phone;
        $contract->amount = $request->amount;
        $contract->fromDate = $request->fromDate;
        $contract->untilDate = $request->untilDate;

        $contract->clientId = $clientId;
        $contract->contractTypeId = $request->contractTypeId;

        $contract->information = $request->information;
        $contract->informationAr = $request->informationAr;




        // 1.3: addressInfo
        $contract->country = $request->country;
        $contract->countryAr = $request->countryAr;
        $contract->state = $request->state;
        $contract->stateAr = $request->stateAr;
        $contract->city = $request->city;
        $contract->cityAr = $request->cityAr;

        $contract->address = $request->address;
        $contract->addressAr = $request->addressAr;
        $contract->note = $request->note;
        $contract->noteAr = $request->noteAr;




        // 1.4: upload image
        if ($request->hasFile('documentFile')) {

            $fileName = $this->uploadFile($request, 'documentFile', 'clients/contracts/');
            $contract->documentFile = $fileName;


        } // end if




        $contract->save();





        // :: response
        return response()->json(['status' => true, 'message' => 'Contract has been added'], 200);




    } // end function









    // ------------------------------------------------------------------------------








    public function updateContract(Request $request, $clientId)
    {



        // 1: get instance
        $contract = ClientContract::find($request->id);



        // 1.2: general
        $contract->name = $request->name;
        $contract->nameAr = $request->nameAr;
        $contract->phone = $request->phone;
        $contract->amount = $request->amount;
        $contract->fromDate = $request->fromDate;
        $contract->untilDate = $request->untilDate;

        $contract->contractTypeId = $request->contractTypeId;

        $contract->information = $request->information;
        $contract->informationAr = $request->informationAr;




        // 1.3: addressInfo
        $contract->country = $request->country;
        $contract->countryAr = $request->countryAr;
        $contract->state = $request->state;
        $contract->stateAr = $request->stateAr;
        $contract->city = $request->city;
        $contract->cityAr = $request->cityAr;

        $contract->address = $request->address;
        $contract->addressAr = $request->addressAr;
        $contract->note = $request->note;
        $contract->noteAr = $request->noteAr;





        // 1.4: upload image
        if ($request->hasFile('documentFile')) {

            $this->deleteFile($contract->documentFile, 'clients/contracts/');
            $fileName = $this->uploadFile($request, 'documentFile', 'clients/contracts/');
            $contract->documentFile = $fileName;


        } // end if





        $contract->save();




        // :: response
        return response()->json(['status' => true, 'message' => 'Contract has been updated'], 200);



    } // end function









    // ------------------------------------------------------------------------------





    public function removeContract($id)
    {


        // 1: get instance
        $contract = ClientContract::find($id);

        $this->deleteFile($contract->documentFile, 'clients/contracts/');
        $contract->delete();



        // :: response
        return response()->json(['status' => true, 'message' => 'Contract has been removed'], 200);


    } // end function






} // end controller
