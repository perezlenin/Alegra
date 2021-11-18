<?php

namespace App\Services\Interfaces;


interface IRecetaIngredientesInterface
{
  
  function getList();
  
  function getByIdReceta(int $id);
  
  function create(array $data);
  
  function update(array $data,int $idreceta,int $idingrediente);
  
  function delete(int $idreceta,int $idingrediente);
  
  function restore(int $idreceta,int $idingrediente);
}
