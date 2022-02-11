<?php

namespace App\Controllers;
use App\Services\Router;

class Auth 
{

    public function login($data)
     {
        $email = $data['email'];
        $password = $data['password'];

        $user = \R::findOne('users', 'email = ?', [$email]); 

        if (!$user) {
            die('User not found');
        }
    

        if (password_verify($password, $user->password)) {
        session_start();
        $_SESSION["user"] = [
            
            "id" => $user->id,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email,
            "status" => $user->status,
            
        ];
        Router::redirect('/profile');

        } else {
            die('Incorrect login or password');
        }

    }

    public function register($data)
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


        $user = \R::dispense('users');
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->firstname =$firstname;
        $user->lastname = $lastname;

        \R::store($user);
        Router::redirect('/login');
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        Router::redirect('/login');
    }



    public function delete($id)
    {
       \R::hunt('users', 'id = ?', [$id]);
       Router::redirect('/userlist');
    }
}