<?php

namespace App\Controllers;
use App\Services\Router;

class Userlist
{

    public function delete($data)
     {
        $id = $data['userid'];

        \R::hunt('users', 'id = ?', [$id]);

        echo 'true';

    }

    public function update($data)
     {

        $id = $data['id'];
        
        $user = \R::findOne('users', 'id = ?', [$id]);
        
        $user->email = $data['email'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->status = $data['status'];
        
        \R::store($user);

        echo 'true';
       
    }

    public function create($data)
    { 
        $email = $data['email'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $password = $data['password'];
        $password_confirm = $data['password_confirm'];
         if ($password !== $password_confirm) {
             Router::error(500);
             die();
         }
            var_dump($data);

        $user = \R::dispense('users');
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->email = $data['email'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];

        \R::store($user);

    }


}