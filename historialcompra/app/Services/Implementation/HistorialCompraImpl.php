<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\IHistorialCompraInterface;
use App\Models\HistorialCompra;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HistorialCompraImpl implements IHistorialCompraInterface
{
    private $model;

    function __construct()
    {
        $this->model = new HistorialCompra();
    }
    
    function getList()
    {
        return DB::table("historialcompras")
                ->select('historialcompras.id', 'historialcompras.cantidad_compra','historialcompras.created_at','ingredientes.ingrediente')
                ->join("ingredientes","historialcompras.idingrediente","ingredientes.id")
                ->get();
        // return $this->model
        //     ->withTrashed() // retorna todos las registros incluye eliminados
        //     ->get();
    }
    
    function getById(int $id)
    {
        return $this->model->find($id);
    }
    
    function create(array $data)
    {
        
        return $this->model->create($data);
    }
        
    function delete(int $id)
    {
        $data = $this->model->find($id);
        if($data != null){
            $data->delete();
        }
        }
    
    function restore(int $id)
    {
        $data = $this->model->withTrashed()->find($id);
        if($data != null){
            $data->restore();
        }
    }
}