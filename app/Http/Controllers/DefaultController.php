<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function listProduct(Request $request)
    {
        $base = base_path() . '/public/images/attribute/product';
        $scan = scandir($base);
        $array = array();
        foreach ($scan as $value) {
            if (!in_array($value, array('..', '.'))) {
                $url = "http://" . $request->getHttpHost() . '/images/attribute/product/' . $value;
                array_push($array, $url);
            }
        }
        return response()->json($array);
    }

    public function listIcon(Request $request) {
        $base = base_path() . '/public/images/icon';
        $scan = scandir($base);
        $array = array();
        foreach ($scan as $value) {
            if (!in_array($value, array('..', '.'))) {
                $url = "http://" . $request->getHttpHost() . '/images/icon/' . $value;
                array_push($array, $url);
            }
        }
        return response()->json($array);
    }
}
