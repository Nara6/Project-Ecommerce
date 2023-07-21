<?php
namespace App\GraphQL\Type;
use App\Models;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
class RoleType extends GraphQLType
{
    protected $attributes = [
        "name" => "Roles",
        "description" => "Collection of roles",
        "model" => Role::class,
    ];
    public function fields(): array
    {
        return [
            "id" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "Id of a particular user",
            ],
            "role" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "The role of the user",
            ],
        ];
    }
}