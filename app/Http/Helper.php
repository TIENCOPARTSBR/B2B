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
        return DirectDistributor::findOrFail(Auth::user()->id_direct_distributor);
    }

    public static function getUserDirectDistributor()
    {
        return UserDirectDistributor::findOrFail(Auth::user()->id_direct_distributor);
    }

    public static function getSystemConfigurationKeyName($r)
    {
        return SystemConfiguration::getSystemKeyName($r);
    }
}
    