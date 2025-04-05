<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use App\Providers\PaisesServicesProvider;

class CountriesQuery extends Query
{
    protected $attributes = [
        'name' => 'countries',
        'description' => 'Trae una lista de paises'
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

 /**
 * @OA\Post(
 *     path="/graphql",
 *     summary="Ejecutar consulta GraphQL de países",
 *     tags={"GraphQL"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"query"},
 *             @OA\Property(
 *                 property="query",
 *                 type="string",
 *                 example="query Countries { countries(limit: 9, username: string) { name population area densidad } }"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Respuesta exitosa con lista de países",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="countries", type="array", @OA\Items(
 *                     @OA\Property(property="name", type="string", example="Argentina"), 
 *                     @OA\Property(property="population", type="integer", example=45000000), 
 *                     @OA\Property(property="area", type="number", format="float", example=2780400),
 *                     @OA\Property(property="densidad", type="number", format="float", example=16.2)
 *                 ))
 *             )
 *         )
 *     )
 * )
 */
    public function resolve($root, $args)
    {   
        $limit = $args['limit'] ?? 10;
        $username = $args['username'] ?? "default";
        $paises = new PaisesServicesProvider();
        
        return $paises->consultarPaises($limit, $username);
    }

    
}