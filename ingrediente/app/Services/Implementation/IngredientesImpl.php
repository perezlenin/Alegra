<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\IIngredientesInterface;
use App\Models\Ingredientes;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class IngredientesImpl implements IIngredientesInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Ingredientes();
    }
    
    function getList()
    {
        return $this->model
            ->withTrashed() // retorna todos las recetas incluye eliminados
            ->get();
    }
    
    function buy($id,$cantidad)
    {
        $sql = "UPDATE ingredientes SET 
                cantidad_disponible = (cantidad_disponible + ?),
                updated_at = ?
                WHERE id = ?";
        DB::statement(
            DB::raw($sql),
            array($cantidad,date("Y-m-d H:i:s"),$id)
        );
    }

    function getIngrediente($id,$cantidad)
    {
        $sql = "UPDATE ingredientes SET 
                cantidad_disponible = (cantidad_disponible - ?),
                updated_at = ?
                WHERE id = ?";
        DB::statement(
            DB::raw($sql),
            array($cantidad,date("Y-m-d H:i:s"),$id)
        );
    }
    function getById(int $id)
    {
        return $this->model->find($id);
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