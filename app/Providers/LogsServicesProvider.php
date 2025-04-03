<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use App\Models\Logs;

class LogsServicesProvider extends ServiceProvider
{

    function __construct() {}

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
    
    public function crearLog($data){
        $log = new Logs();

        $data = (object) $data;
        $log->username = $data->username;
        $log->request_timestamp = $data->request_timestamp;
        $log->num_countries_returned = $data->num_countries_returned;
        $log->countries_details = $data->countries_details;
        $log->save();        
    }
}