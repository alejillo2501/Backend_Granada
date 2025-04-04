<?php

namespace App\GraphQL\Mutations;

use App\Models\Country;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Providers\LogsServicesProvider;

class UpdateLogMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateLog',
        'description' => 'Actualiza el usuario de un log'
    ];

    public function type(): Type
    {
        return GraphQL::type('Log');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::int()],
            'username' => ['type' => Type::string()]                     
        ];
    }

    public function resolve($root, $args)
    {
        $log = new LogsServicesProvider();

        return $log->actualizaLog($args);
    }
}
