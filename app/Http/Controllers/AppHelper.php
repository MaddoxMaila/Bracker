<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppHelper extends Controller
{

    public static function error(string $e){

        return /*response()->json(*/[
            'error'=> true,
            'message' => $e
        ]/*)*/;

    }

}
