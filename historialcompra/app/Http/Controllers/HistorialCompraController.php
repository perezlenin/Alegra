<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Implementation\HistorialCompraImpl;
use App\Validator\HistorialCompraValidator;

class HistorialCompraController extends Controller
{
    private $ingredienteService;
    private $request;
  
    private $validator;
  
    public function __construct(HistorialCompraImpl $ingredienteservice,
                                Request $request,HistorialCompraValidator $validator)
    {
        $this->ingredienteService = $ingredienteservice;
        $this->request = $request;
        $this->validator = $validator;
    }

    function create()
    {
        $id = "";
        $response  = response("Historial creado",201);
        $validator = $this->validator->validate();
        if($validator->fails()){
            $response = response([
            "status" => 422,
            "message" => "Error",
            "errors" => $validator->errors()
            ],422);
        }else{
            $this->ingredienteService->create($this->request->all());
            
        }
        return $response;
    }

    function getList()
    {
        return response($this->ingredienteService->getList());
    }

    function delete(int $id)
    {
        $response = response("",204); // el codigo 2024 no se usa en el standra HTTP response
        $this->ingredienteService->delete($id);
        return $response;
    }

    function restore(int $id)
    {
        $response = response("",204); // el codigo 2024 no se usa en el standra HTTP response
        $this->ingredienteService->restore($id);
        return $response;
    }


}
