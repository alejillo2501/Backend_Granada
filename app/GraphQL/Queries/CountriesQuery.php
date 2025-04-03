<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Http;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use App\Providers\AppServiceProvider;
use App\Providers\LogsServicesProvider;

class CountriesQuery extends Query
{
    protected $attributes = [
        'name' => 'countries'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Country'));
    }

    public function args(): array
    {
        return [
            'limit' => [
                'type' => Type::int(),
                'description' => 'Cantidad máxima de resultados a retornar'
            ],
            'username' => [
                'type' => Type::string(),
                'description' => 'Cantidad máxima de resultados a retornar'
            ]         
        ];
    }


    public function resolve($root, $args)
    {   
        $limit = $args['limit'] ?? 10;
        $username = $args['username'] ?? "default";

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
        foreach ($data as &$fila) {            
            if (!array_key_exists('area', $fila)) {
                $fila['densidad'] = 0;
            }else{
                $fila['densidad'] = $fila['population'] / $fila['area'];
            }
        }
        return $data;
    }
}