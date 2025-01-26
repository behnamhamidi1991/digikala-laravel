<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    

    protected $fillable = ['name'];

    
    public function submit($formData)
    {
        Country::query()->create([
            'name' => $formData['name']
        ]);
    }
}
