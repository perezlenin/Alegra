<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Implementation\IngredientesImpl;
use App\Validator\IngredienteValidator;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\DB;

class IngredienteController extends Controller
{
    private $ingredienteService;
    private $request;
  
    private $validator;
  
    public function __construct(IngredientesImpl $ingredienteservice,
                                Request $request,IngredienteValidator $validator)
    {
        $this->ingredienteService = $ingredienteservice;
        $this->request = $request;
        $this->validator = $validator;
    }

    function buy(int $id,int $idpedido)
    {
        // realizar compra
        $api_mercado = env("API_MERCADO");
        $host_historial = env("IP_HISTORIAL");
        $ingrediente_service = $this->ingredienteService;
        $obj_ing = $this->ingredienteService->getById($id);
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get($api_mercado."?ingredient=".$obj_ing->ingrediente)->then(function($resp) use ($id,$idpedido,$host_historial,$ingrediente_service){
                $json_resp = json_decode($resp);
                $ingrediente_service->buy($id,$json_resp->quantitySold);
                // guardar el historial
                $reponse = Http::post("http://".$host_historial."/v1/register",[
                    "idingrediente" => $id,
                    "idpedido" => $idpedido,
                    "cantidad_compra" => $json_resp->quantitySold
                ]);
            }),
            
        ]);
        $resp = array("status"=> 201,"msg"=>"Compra realizada");
        return $resp;
    }

    function getIngrediente()
    {
        // DB::table("test")->insert(["test"=>print_r($this->request->all(),true)]);
        // $this->ingredienteService->getIngrediente($id,$cantidad);
        // var_dump($this->request->all());
        $arr_ing = $this->request->all();
        foreach($arr_ing as $k=> $ing)
        {
            $this->ingredienteService->getIngrediente($ing["idingrediente"],$ing["cantidad"]);
        }
    }

    function create()
    {
        $id = "";
        $response  = response("Ingrediente creada",201);
        $validator = $this->validator->validate();
        if($validator->fails()){
            $response = response([
            "status" => 422,
            "message" => "Error",
            "errors" => $validator->errors()
            ],422);
        }else{
            $tmp_data = $this->request->all();
            $tmp_data["created_at"] = \Carbon\Carbon::now();
            $tmp_data["updated_at"] = \Carbon\Carbon::now();
            $id_ingrediente = $this->ingredienteService->create($tmp_data);
            
        }
        return $response;
    }

    function getList()
    {
        // sleep(2);
        return response($this->ingredienteService->getList());
    }

    function update(int $id)
    {
        $response = response("",202);

        $validator = $this->validator->validate();
        if($validator->fails()){
            $response = response([
            "status" => 422,
            "message" => "Error2",
            "errors" => $validator->errors()
            ],422);
        }else{
            $this->ingredienteService->update($this->request->all(),$id);
        }
    return $response;
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
