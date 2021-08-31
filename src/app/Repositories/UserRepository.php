<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{	
    private $user;

    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    public function getById($id){

        $user = $this->user->where('id', $id)->first();

        return $user;
    }

    public function getWarehouses(){

        $warehouses = $this->user->where('role_id', '2')->get();

        return $warehouses;
    }

}