<?php

namespace app\Traits;

trait EnumKeyValiable
{
    public static function keyLabel(): array {
        $array = [];
        foreach (self::cases() as $enum) {
            $array[$enum->value] = $enum->label();
        }
        return $array;
    }
}

