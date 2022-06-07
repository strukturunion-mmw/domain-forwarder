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
        $urlPath = trim($request->getRequestUri()) != "/" ? $request->getRequestUri() : "";

        // Resolve from DB
        $target = $this->resolve($urlServer, $urlPath);
        
        // Uncomment for Testing | Outputs Source -> Target
        //dd ($urlServer.$urlPath." -> ".$target);

        die( header("Location:{$target}", true, 301) );

    }

    /**
     * Resolves first matching or Default Route for Request URL from database
     *
     * @param  string  $urlServer   // Domain Part of URL
     * @param  string  $urlPath     // Path Part of URL
     * @return string
     */
    private Function resolve ($urlServer, $urlPath) {

        $redirectTo = "";

        // Find match in Database
        $match = Forward::
            where('request', $urlServer.$urlPath)   // Find FUll URL
            ->orWhere('request', $urlServer)        // Find ONLY Server URL
            ->orWhere('request', 'default')         // Find default Route
            ->select('request', 'target')
            ->orderBy('id')
            ->get()
            ->collect();
        
        // Use first match in order: Full URL match > Only server Match > Default
        $match = $match->keyBy('request');
        if(isset($match[$urlServer.$urlPath])) $redirectTo = $match[$urlServer.$urlPath]['target'];
        elseif(isset($match[$urlServer])) $redirectTo = $match[$urlServer]['target'];
        else $redirectTo = $match['default']['target'];

        // Return redirection if found. Else return Default Route (First entry in Match Resultset)
        return $redirectTo;

    }

}

