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

    public function consultarLogs(){
        return Logs::all();
    }

    public function consultarLogsFilterDate($data){
        $data = (object) $data;
        $from = date($data->from);
        $to = date($data->to);

        if($from == $to){
            return Logs::where('request_timestamp', 'like', $from.'%')->get();
        }

        $to = strtotime('+1 day', strtotime($to));
        $to = date('yyyy-mm-dd', $to);        

        return Logs::whereBetween('request_timestamp', [$from, $to])->get();
    }

    public function actualizaLog($data){
        $data = (object) $data;

        $log = Logs::find($data->id);
        $log->username = $data->username;
        $log->save();

        return $log;
    }

    public function eliminaLog($data){
        $data = (object) $data;

        Logs::find($data->id)->delete();
        return Logs::all();
    }
}