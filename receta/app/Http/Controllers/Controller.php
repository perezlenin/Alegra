<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // para que las respuesta envian json de forma automatica
    public function response($data,$status = 200)
    {
      return response()->json($data,$status);
    }
}
