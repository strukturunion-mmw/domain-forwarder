<?php

namespace App\Http\Controllers;

use App\Models\Forward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ForwardController extends Controller
{

    /**
     * Resolves first matching or Default Route for Request URL from database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public Function redirect ($request) {

        // Extract URL parts from Request
        $urlServer = $request->server ('HTTP_HOST');
        $urlPath = trim($request->requestUri) != "/" ? $request->requestUri : "";

        // Resolve from DB
        $target = $this->resolve($urlServer . $urlPath);

        die( header("Location:{$target}", true, 301) );

    }

    /**
     * Resolves first matching or Default Route for Request URL from database
     *
     * @param  string  $url
     * @return string
     */
    private Function resolve ($url) {

        // Find match in Database
        $match = Forward::where('request', $url)->orWhere('request', 'default')->select('target')->orderBy('id')->get()->toArray();

        // Return redirection if found. Else return Default Route (First entry in Match Resultset)
        return isset($match[1]) ? $match[1]['target'] : $match[0]['target'];

    }

}

