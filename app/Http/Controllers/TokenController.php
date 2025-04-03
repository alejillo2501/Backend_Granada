<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * @OA\Get(
     *     path="/token",
     *     summary="Ver token",
     *     tags={"Token"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */

     public function index(Request $request){
        return response()->json([
            'token' => csrf_token()
        ],200);
    }
}
