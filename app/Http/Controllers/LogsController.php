<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\LogsServicesProvider;

class LogsController extends Controller
{
    public function index(Request $request){
        $log = new LogsServicesProvider();

        return $log->consultarLogs();
    }
}
