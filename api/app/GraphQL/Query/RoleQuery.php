<?php
namespace App\GraphQL\Query;
use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
class UsersQuery extends Query
{
    protected $attributes = [
        "name" => "roles",
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Roles"));
    }
    public function resolve($root, $args)
    {
        return Role::all();
        // echo var_dump(User::all());
    }
}