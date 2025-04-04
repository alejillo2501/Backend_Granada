<?php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LogType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Log',
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'username' => ['type' => Type::string()],
            'request_timestamp' => ['type' => Type::string()],
            'num_countries_returned' => ['type' => Type::int()],
            'countries_details' => ['type' => Type::string()],                       
        ];
    }
}