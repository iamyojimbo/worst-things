<?php

namespace App\Repositories\Interfaces;

use App\Models\Interfaces\Id;

interface RepositoryInterface
{ 
   public function getById(Id $id);
   public function getAll();
}
