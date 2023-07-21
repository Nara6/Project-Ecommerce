<?php
namespace App\GraphQL\Type;
use App\Models;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
class UserType extends GraphQLType
{
    protected $attributes = [
        "name" => "Users",
        "description" => "Collection of users",
        "model" => Users::class,
    ];
    public function fields(): array
    {
        return [
            "id" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "Id of a particular user",
            ],
            "username" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "The name of the user",
            ],
            "email" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "email of the user",
            ],
            "phone" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "the number phone of the user",
            ],
            "role" => [
                "type" => GraphQL::type('Roles'),
                "description" => "the role of the user",
            ],
            "password" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "the password of the user",
            ],
        ];
    }
}