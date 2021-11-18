<?php

namespace App\Services\Interfaces;


interface IHistorialCompraInterface
{
  
  function getList();
  
  function getById(int $id);
  
  function create(array $data);
    
  function delete(int $id);
  
  function restore(int $id);
}
