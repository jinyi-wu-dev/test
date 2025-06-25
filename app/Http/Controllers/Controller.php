<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function splitMultiParameters($params) {
        $single_params = array();
        $multi_params = array();
        foreach ($params as $key => $value) {
            $exp = explode(':', $key, 2);
            if (count($exp)==2) {
                $multi_params[$exp[0]][$exp[1]] = $value;
            } else {
                $single_params[$key] = $value;
            }
        }

        return [$single_params, $multi_params];
    }

    protected function localeView($view, $params=[]) {
        return view(sprintf($view, app()->getLocale()), $params);
    }
}
