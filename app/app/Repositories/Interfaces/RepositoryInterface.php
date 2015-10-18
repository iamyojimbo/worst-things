<?php

namespace App\Repositories\Interfaces;


interface RepositoryInterface
{ 
   public function getById($id);
   public function getAll();
}
