<?php

namespace XD\Basic\GraphQL\Resolvers;

use GraphQL\Type\Definition\ResolveInfo;

class Resolvers
{
    public static function resolveActionCard($obj, $args = [], $context = [], ?ResolveInfo $info = null)
    {
        $fieldName = ucfirst($info->fieldName);
        return $obj->{$fieldName};
    }
}
