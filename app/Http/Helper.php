<?php 

namespace App\Http;

use App\Models\DirectDistributor;
use App\Models\SystemConfiguration;
use App\Models\UserDirectDistributor;
use Illuminate\Support\Facades\Auth;

class Helper 
{
    public static function getDirectDistributorLogged()
    {
        return DirectDistributor::findOrFail(Auth::guard('direct-distributor')->user()->direct_distributor_id);
    }

    public static function getUserDirectDistributor()
    {
        return UserDirectDistributor::findOrFail(Auth::guard('direct-distributor')->user()->direct_distributor_id);
    }

    public static function getSystemConfigurationKeyName($r)
    {
        return SystemConfiguration::getSystemKeyName($r);
    }
}
    