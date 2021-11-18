<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\IRecetaIngredientesInterface;
use App\Models\RecetaIngredientes;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class RecetaIngredientesImpl implements IRecetaIngredientesInterface
{
    private $model;

    function __construct()
    {
        $this->model = new RecetaIngredientes();
    }
    
    function getList()
    {
        return $this->model
            ->withTrashed() // retorna todos las recetas incluye eliminados
            ->get();
    }
  
    
    function getByIdReceta(int $id)
    {
        return DB::table("receta_ingredientes")
            ->join("ingredientes","receta_ingredientes.idingrediente","=","ingredientes.id")
            ->where("receta_ingredientes.idreceta",$id)
            ->get();

    }
    
    function create(array $data)
    {
        return $this->model->create($data);
    }
    
    function update(array $data,int $idreceta,int $idingrediente)
    {
        $this->model->where("idreceta",$idreceta)
            ->where("idingrediente",$idingrediente)
            ->first()
            ->fill($data)
            ->save();
    }
    
    function delete(int $idreceta,int $idingrediente)
    {
        $data = $this->model->where("idreceta",$idreceta)
                            ->where("idingrediente",$idingrediente)
                            ->first()
                            ->get();
        if($data != null){
            $data->delete();
        }
    }
    
    function restore(int $idreceta,int $idingrediente)
    {
        $data = $this->model->where("idreceta",$idreceta)
                            ->where("idingrediente",$idingrediente)
                            ->first()
                            ->get();
        if($data != null){
            $data->restore();
        }
    }

}