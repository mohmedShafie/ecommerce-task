<?php
namespace App\Http\CPU;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AgencyAuthHelper
{

    public static function setConfig()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin) {
            config()->set('agency.user_id', $admin->id);
            config()->set('agency.name', $admin->name);
            config()->set('agency.role_id', $admin->agency_role_id);
            config()->set('agency.country_id', Admin::find($admin->agency_id)?->country_id);
        }
    }


}
