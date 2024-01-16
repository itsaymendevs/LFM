<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;



    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'clientTypeId');
    }



    public function branchCity()
    {
        return $this->belongsTo(City::class, 'branchCityId');
    }



    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalityId');
    }



} // end model
