<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function splitMultiParameters($request) {
        $single_params = array();
        $multi_params = array();
        foreach ($request->all() as $key => $value) {
            $exp = explode(':', $key);
            if (count($exp)==2) {
                $multi_params[$exp[0]][$exp[1]] = $value;
            } else {
                $single_params[$key] = $value;
            }
        }

        return [$single_params, $multi_params];
    }
    //
}
