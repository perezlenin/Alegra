<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Implementation\RecetaServiceImpl;
use App\Services\Implementation\RecetaIngredientesImpl;
use App\Validator\RecetaValidator;// pendiente

class RecetaController extends Controller
{
    private $recetaService;
    private $recetaingservice;
    private $request;
  
    private $validator;
  
    public function __construct(RecetaServiceImpl $recetaservice,
                                RecetaIngredientesImpl $recetaingservice,
                                Request $request,RecetaValidator $validator)
    {
        $this->recetaService = $recetaservice;
        $this->recetaingservice = $recetaingservice;
        $this->request = $request;
        $this->validator = $validator;
    }

    function create()
    {
        $id = "";
        $response  = response("Receta creada",201);
        $validator = $this->validator->validate();
        if($validator->fails()){
            $response = response([
            "status" => 422,
            "message" => "Error",
            "errors" => $validator->errors()
            ],422);
        }else{
            $tmp_data = $this->request->all();
            $data = array("receta"=>$tmp_data["receta"],
                            "created_at"=>\Carbon\Carbon::now(),
                            "updated_at"=>\Carbon\Carbon::now()
                        );
            $id_receta = $this->recetaService->create($data);
            
            $this->request->collect("ingredientes")->each(function ($ing) use($id_receta) {
                $data_ing = array("idreceta"=>$id_receta,
                                    "idingrediente"=>$ing["id"],
                                    "cantidad_ingrediente"=>$ing["cantidad"]
                                );
                $this->recetaingservice->create($data_ing);                
            });
        }
        return $response;
    }

    function getListRand()
    {
        $obj_receta = $this->recetaService->getListRand();
        // listar los ingredientes
        $lst_ingre = $this->recetaingservice->getByIdReceta($obj_receta->id);
        $obj_receta->ingredientes = $lst_ingre;
        $tmp_resp = array("receta"=>$obj_receta);
        return $tmp_resp;    
    }

    function getByIdWIthIngredientes(int $id)
    {
        $obj_receta = $this->recetaService->getById($id);
        $lst_ingre = $this->recetaingservice->getByIdReceta($obj_receta->id);
        $obj_receta->ingredientes = $lst_ingre;
        $tmp_resp = array("receta"=>$obj_receta);
        return $tmp_resp;  
    }

    function getList()
    {
        $lst_recetas = $this->recetaService->getList();
        
        foreach($lst_recetas as $key => &$receta)
        {
            $receta->ingredientes = $this->recetaingservice->getByIdReceta($receta->id);
        }
        return response($lst_recetas);
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
            $this->recetaService->update($this->request->all(),$id);
        }
    return $response;
    }

    function delete(int $id)
    {
        $response = response("",204); // el codigo 2024 no se usa en el standra HTTP response
        $this->recetaService->delete($id);
        return $response;
    }

    function restore(int $id)
    {
        $response = response("",204); // el codigo 2024 no se usa en el standra HTTP response
        $this->recetaService->restore($id);
        return $response;
    }


}
