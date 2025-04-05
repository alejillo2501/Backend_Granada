<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use App\Providers\AppServiceProvider;
use App\Providers\LogsServicesProvider;

class PaisesServicesProvider extends ServiceProvider
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

    public function consultarPaises($limit, $username){

        $data = Http::get('https://www.apicountries.com/countries');  
        //$data = Http::get('https://restcountries.com/v3.1/all'); 
        $data = $data->json();
        

        $response = $this->addDensidad($data);

        $order = new AppServiceProvider();
        $log = new LogsServicesProvider();
        $response = $order->array_sort($response, 'densidad', SORT_DESC);
        $response = array_slice($response, 0, $limit);

        $logData = [
            'username' => $username,
            'request_timestamp' => date("Y-m-d H:i:s"),
            'num_countries_returned' => $limit,
            'countries_details' => json_encode($response)
        ];

        $log->crearLog($logData);

        return $response;
    }

    private function addDensidad($data){
        $arrayData = [];
        foreach ($data as &$fila) {   
            $densidad = 0; 
            $area = 0;

            if (array_key_exists('area', $fila)) {
                $densidad = $fila['population'] / $fila['area'];
                $area = $fila['area'];
            }

            $schema = array(
                'name' => $fila['name'],
                'population' => $fila['population'],
                'area' => $area,
                'densidad' => $densidad
            );

            array_push($arrayData, $schema);
            
        }
        return $arrayData;
    }
}
