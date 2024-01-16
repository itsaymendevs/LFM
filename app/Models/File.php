<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;


    public function client()
    {
        return $this->hasMany(Client::class, 'clientId');
    }


    public function branchCity()
    {
        return $this->hasMany(City::class, 'branchCityId');
    }



    public function cases()
    {
        return $this->hasMany(FileCase::class, 'fileId');
    }



    public function associatedCases()
    {
        return $this->hasMany(FileAssociatedCase::class, 'fileId');
    }










} // end model
