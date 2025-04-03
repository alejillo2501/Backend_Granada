<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaisesController extends Controller
{
    public function index(){
        $response = Http::get('https://www.apicountries.com/countries');
        $data = $response->json();

        foreach ($data as &$fila) {            
            if (!array_key_exists('area', $fila)) {
                dd($fila);
                $fila['densidad'] = 0;
            }else{
                $fila['densidad'] = $fila['population'] / $fila['area'];
            }
            
        }

        unset($fila);

        dd($data);
        return $response->json();
    }
}
