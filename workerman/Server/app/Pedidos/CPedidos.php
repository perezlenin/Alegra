<?php 

namespace Server\app\Pedidos;

use Server\database\async_db;
use Server\database\class_pdo;


class CPedidos
{
	static $db;

	static $path_log = "pedidos/log_compra";
	static $title_log = "LOG PEDIDOS";

	function __construct()
	{
		self::$db = new class_pdo();
        $this->async_db = new async_db();
	}

	public function verificarPedidos()
	{
        $sql = "SELECT * FROM pedidos where estado = 1";

		$this->async_db->query($sql,array(),function($task_connection,$task_result){
			$task_connection->close();
			$lst_pedidos = json_decode($task_result);
            // var_dump($lst_pedidos);
			if(!empty($lst_pedidos)){
                $http = new \Workerman\Http\Client();
                foreach ($lst_pedidos as $key => $pedido) {
                    // obtener las recetas con sus ingredientes
                    $http->get('http://'.IP_RECETA.'/v1/get/'.$pedido->idreceta, function($response) use ($pedido){
                        $resp = json_decode($response->getBody());
                        $espera_compra = false;
                        $http_int = new \Workerman\Http\Client();
                        $arr_ing = array();
                        foreach ($resp->receta->ingredientes as $k => $ing) {
                            if($ing->cantidad_disponible < $ing->cantidad_ingrediente){
                                $espera_compra = true;
                                // comprar el ingrediente
                                var_dump("Comprando...".'http://'.IP_INGREDIENTE.'/v1/buy/'.$ing->idingrediente."/".$pedido->id);
                                $http_int->get('http://'.IP_INGREDIENTE.'/v1/buy/'.$ing->idingrediente."/".$pedido->id, function($response_int){
                                    // var_dump($response_int->getBody());
                                });
                            }
                            $arr_ing[] = (object) array("idingrediente"=>$ing->idingrediente,"cantidad"=>$ing->cantidad_ingrediente);
                        }
                        if(!$espera_compra){
                            // actualizar el pedido a en preparacion
                            $arr_pedido = array("estado"=>2,
                                            "updated_at"=>date("Y-m-d H:i:s")
                                            );
                            self::$db->table("pedidos")->where("id","=",$pedido->id)->update($arr_pedido);
                            // pedir los ingredientes de almacen para restarlos
                            $http_int->post('http://'.IP_INGREDIENTE.'/v1/get/',$arr_ing, function($response_int_2){
                                // var_dump($response_int->getBody());
                            });
                        }
                    }, function($exception){
                        save_log_file($exception,self::$path_log,self::$title_log);
                    });
                }
            }
            // $msg = "Not found data";
            // save_log_file($msg,self::$path_log,self::$title_log);

		});
		

	}
}


 ?>