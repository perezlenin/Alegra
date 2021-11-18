<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\IPedidosInterface;
use App\Models\Pedido;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PedidosImpl implements IPedidosInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Pedido();
    }
    
    function getList()
    {
        return DB::table("pedidos")
            ->select('pedidos.id', 'receta.receta','pedidos.estado','pedidos.created_at')
            ->join("receta","pedidos.idreceta","receta.id")
            ->get();
        // return $this->model
        //     ->withTrashed() // retorna todos las recetas incluye eliminados
        //     ->get();
    }
  
    function getById(int $id)
    {
        return $this->model->where("idreceta",$id)->get();
    }
    
    function create(array $data)
    {
        return $this->model->insertGetId($data);
    }
    
    function update(array $data,int $id)
    {
        $this->model->where("id",$id)
            ->first()
            ->fill($data)
            ->save();
    }
    
    function delete(int $id)
    {
        $data = $this->model->where("id",$id)
                            ->first()
                            ->get();
        if($data != null){
            $data->delete();
        }
    }
    
    function restore(int $id)
    {
        $data = $this->model->where("id",$id)
                            ->first()
                            ->get();
        if($data != null){
            $data->restore();
        }
    }

}