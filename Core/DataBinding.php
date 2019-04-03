<?php

namespace Core;


class DataBinding
{
    public function bind(array $data, string $class_name){

        $class = new $class_name();
        foreach ($data as $key => $value) {
            $tokens = explode("_", $key);
            $methodName = 'set'.$tokens[0];
            for ($i = 1; $i < count($tokens); $i++) {
                $methodName .= ucfirst($tokens[1]);
            }

            if (method_exists($class, $methodName)) {
                $class->$methodName($value);
            }
        }

        return $class;
    }
}