<?php


namespace App\Services;


use App\Models\User;

class UserService
{

    public function getUser()
    {

    }

    public function storeUser(array $data)
    {
       $user = User::create($data);

       return $user;
    }


    public function updateUser()
    {

    }

    public function destroyUser()
    {

    }

}
