<?php
namespace App\Http\CPU;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CustomerAuthHelper
{

    public static function setConfig()
    {
        $customer = Auth::guard('customer')->user();

        if ($customer) {
            config()->set('customer.id', $customer->id);
            config()->set('customer.name', $customer->name);
            config()->set('customer.country_id', Customer::find($customer->country_id)?->country_id);
            config()->set('customer.city_id', Customer::find($customer->city_id)?->city_id);
            config()->set('customer.region_id', Customer::find($customer->region_id)?->region_id);
        }
    }


}
