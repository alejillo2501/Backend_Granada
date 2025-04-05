<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Http;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use App\Providers\AppServiceProvider;
use App\Providers\LogsServicesProvider;

class LogsQuery extends Query
{
    protected $attributes = [
        'name' => 'logs',
        'description' => 'Trae una lista de losg'
    ];

    public function args(): array
    {
        return [
            'from' => [
                'type' => Type::string(),
                'description' => 'Fecha de inicio logs'
            ],
            'to' => [
                'type' => Type::string(),
                'description' => 'Fecha de fin logs'
            ]         
        ];
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Log'));
    }
   

 /**
 * @OA\Post(
 *     path="/graphql",
 *     summary="Ejecutar consulta GraphQL de logs",
 *     tags={"GraphQL"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"query"},
 *             @OA\Property(
 *                 property="query",
 *                 type="string",
 *                 example="query Logs { logs(limit: 9,) { name capital region population flag area densidad } }"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Respuesta exitosa con lista de logs",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="countries", type="array", @OA\Items(
 *                     @OA\Property(property="username", type="string", example="Alejolondono"),
 *                     @OA\Property(property="request_timestamp", type="string", example="2025-04-03 21:01:08"),
 *                     @OA\Property(property="num_countries_returned", type="int", example="7"),
 *                     @OA\Property(property="countries_details", type="integer", example=[{\"name\":\"Macao\",\"topLevelDomain\":[\".mo\"],\"alpha2Code\":\"MO\"])
 *                 ))
 *             )
 *         )
 *     )
 * )
 */
    public function resolve($root, $args)
    {           
        $log = new LogsServicesProvider();
        
        if (array_key_exists("from",$args) && array_key_exists("to",$args)){
            return $log->consultarLogsFilterDate($args);
        }else{
            return $log->consultarLogs();
        }
        
    }
    
}