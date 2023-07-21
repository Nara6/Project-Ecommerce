<?php
namespace App\GraphQL\Query;
use App\Models\Users;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
class UsersQuery extends Query
{
    protected $attributes = [
        "name" => "users",
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Users"));
    }
    public function resolve($root, $args, SelectFields $fields)
    {
        $user = User::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect());
        return $user;
        // echo var_dump(User::all());
    }
}