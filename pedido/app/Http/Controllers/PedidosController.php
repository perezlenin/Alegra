<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Implementation\PedidosImpl;
use App\Services\Implementation\RecetaIngredientesImpl;
use App\Validator\PedidosValidator;// pendiente

use Illuminate\Support\Facades\Http;

use \GuzzleHttp\Promise\EachPromise;
use \GuzzleHttp\Psr7\Response;

use Illuminate\Http\Client\Pool;

class PedidosController extends Controller
{
    private $pedidoService;
    private $request;
  
    private $validator;
  
    public function __construct(PedidosImpl $pedidoservice,
                                Request $request,PedidosValidator $validator)
    {
        $this->pedidoService = $pedidoservice;
        $this->request = $request;
        $this->validator = $validator;
    }

    
    function realizarPedido()
    {
        
        $host_receta = env("IP_RECETA");
        $host_ingredientes = env("IP_INGREDIENTE");
        
        $pedidoService = $this->pedidoService;
        // listar las recetas y elegir uno al azar
        $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', 'http://'.$host_receta.'/v1/list-rand');
        $promise = $client->sendAsync($request)->then(function ($response) use($host_ingredientes,$pedidoService){
            // var_dump(json_decode($response->getBody()));
            $obj_receta = json_decode($response->getBody());
            if(empty($obj_receta)){
                return response("No hay recetas disponibles",200);
            }
            // recorrer los ingredientes para evaluar si hay
            $responses = Http::pool(function(Pool $pool) use ($obj_receta,$host_ingredientes,$pedidoService){
                $espera_compra = false;
                $arr_ing = array();
                foreach($obj_receta->receta->ingredientes as $k => $ing)
                {
                    if($ing->cantidad_disponible < $ing->cantidad_ingrediente){
                        // informar de la compra
                        $espera_compra = true;
                        $pool->get('http://'.$host_ingredientes.'/v1/buy/'.$ing->idingrediente)->then();
                    }
                    $arr_ing[] = (object) array("idingrediente"=>$ing->idingrediente,"cantidad"=>$ing->cantidad_ingrediente);
                }
                $data_pedido = array("idreceta"=>$obj_receta->receta->id,
                                    "created_at"=>\Carbon\Carbon::now(),
                                    "updated_at"=>\Carbon\Carbon::now()
                                );
                if($espera_compra){
                    // actualizar el pedido en espera
                    $data_pedido["estado"] = 1;// en espera (comprando...)
                }else{
                    $data_pedido["estado"] = 2;// en preparacion
                    // pedir los ingredientes
                    // $pool->post('http://'.$host_ingredientes.'/v1/get',$arr_ing)->then();
                    $response = Http::post('http://'.$host_ingredientes.'/v1/get',$arr_ing);
                    var_dump($response);
                }            
                $pedidoService->create($data_pedido);
            });
            // var_dump($responses);
            // exit;
        });
        $promise->wait();
        
    }

    function create()
    {
        $id = "";
        $response  = response("Pedido recibido",201);
        $validator = $this->validator->validate();
        if($validator->fails()){
            $response = response([
            "status" => 422,
            "message" => "Error",
            "errors" => $validator->errors()
            ],422);
        }else{
            
            $data = array("idreceta"=>1,
                            "created_at"=>\Carbon\Carbon::now(),
                            "updated_at"=>\Carbon\Carbon::now()
                        );
            $id_pedido = $this->pedidoService->create($data);
            
        }
        return $response;
    }

    function getList()
    {
        return response($this->pedidoService->getList());
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
            $this->pedidoService->update($this->request->all(),$id);
        }
    return $response;
    }

    function delete(int $id)
    {
        $response = response("",204); // el codigo 2024 no se usa en el standra HTTP response
        $this->pedidoService->delete($id);
        return $response;
    }

    function restore(int $id)
    {
        $response = response("",204); // el codigo 2024 no se usa en el standra HTTP response
        $this->pedidoService->restore($id);
        return $response;
    }


}
