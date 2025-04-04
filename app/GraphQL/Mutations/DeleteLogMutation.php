<?php

namespace App\GraphQL\Mutations;

use App\Models\Country;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Providers\LogsServicesProvider;

class DeleteLogMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteLog',
        'description' => 'Elimina un log'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Log'));
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()]                   
        ];
    }

    public function resolve($root, $args)
    {
        $log = new LogsServicesProvider();

        return $log->eliminaLog($args);
    }
}
