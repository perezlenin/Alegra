<?php

namespace App\Services\Interfaces;


interface IRecetaServiceInterface
{
  
  function getList();
  
  function getById(int $id);
  
  function create(array $receta);
  
  function update(array $receta,int $id);
  
  function delete(int $id);
  
  function restore(int $id);
}
