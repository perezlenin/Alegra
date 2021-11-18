<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredienteValidator 
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        return Validator::make($this->request->all(),$this->rules(),$this->messages());
    }

    public function rules()
    {
        return [
            "ingrediente" => "required|unique:ingredientes,ingrediente,".$this->request->id,
            "cantidad_disponible" => "required|integer|min:1"
            // "document_number" => "required|unique:users,document_number,".$this->request->id,// validacion en caso de edicion
            // "email" => "required|email|unique:users,email,".$this->request->id,
            // "password" => "required",
            // "confirm_password" => "required|same:password",
        ];
    }

    public function messages()
    {
        return [];
    }
  
}