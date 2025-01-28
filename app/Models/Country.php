<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    

    protected $fillable = ['name'];

    
    public function submit($formData, $countryId)
    {
        Country::query()->updateOrCreate(
         
             [
                'id' => $countryId,
              ],

             [
            'name' => $formData['name']
              ]
    );
    }
}
