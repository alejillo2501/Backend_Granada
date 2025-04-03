<?php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CountryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Country',
    ];

    public function fields(): array
    {
        return [
            'name' => ['type' => Type::string()],
            'capital' => ['type' => Type::string()],
            'region' => ['type' => Type::string()],
            'population' => ['type' => Type::int()],
            'flag' => ['type' => Type::string()],
            'area' => ['type' => Type::float()],            
            'densidad' => ['type' => Type::float()],            
        ];
    }
}