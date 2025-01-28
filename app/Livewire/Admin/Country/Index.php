<?php

namespace App\Livewire\Admin\Country;

use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $name;
    public $countryId;

    public function submit($formData, Country $country)
    {
        $validator = Validator::make($formData, [
            'name' => 'required|string|max:30'
        ], [
            '*.required' => 'فیلد ضروری می باشد',
            '*.string' => 'مقدار وارد شده مجاز نمی باشد',
            '*.max' => 'تعداد کاراکترها بیش از حد مجاز است'
        ]);

        $validator->validate();
        $country->submit($formData, $this->countryId);
        $this->reset();
        $this->dispatch('success', 'عملیات با موفقیت انجام شد');

    }

    public function edit($country_id)
    {   
        $country = Country::query()->where('id', $country_id)->first();

        if ($country) {
            $this->name = $country->name;
            $this->countryId = $country->id;
        }
    }

    public function delete($country_id) 
    {
        Country::query()->where('id', $country_id)->delete();
        $this->dispatch('success', 'آیتم با موفقیت حذف شد');
    }


    public function render()
    {

        $countries = Country::paginate(10);

        return view('livewire.admin.country.index', [
            'countries' => $countries
        ])->layout('layouts.admin.app');
    }
}
