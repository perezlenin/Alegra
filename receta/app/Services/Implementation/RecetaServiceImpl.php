<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\IRecetaServiceInterface;
use App\Models\Receta;

use Illuminate\Support\Facades\DB;

class RecetaServiceImpl implements IRecetaServiceInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Receta();
    }
    
    function getListRand()
    {
        return DB::table("receta")
                ->orderByRaw('RAND()')
                // ->limit(1)
                ->first();
    }

    function getList()
    {
        
        return $this->model
            // ->ingredientes()
            // ->withTrashed() // retorna todos las recetas incluye eliminados
            ->get();
            // ->toSql();
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