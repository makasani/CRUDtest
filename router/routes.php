<?php

use App\Services\Router;
use App\Controllers\Auth;
use App\Controllers\Userlist;



Router::page('/login', 'login');
Router::page('/register', 'register');
Router::page('/', 'home');
Router::page('/profile', 'profile');
Router::page('/admin', 'admin');
Router::page('/userlist', 'userlist');


Router::post('/auth/register', Auth::class, 'register');
Router::post('/auth/login', Auth::class, 'login');
Router::post('/auth/logout', Auth::class, 'logout');

Router::post('/userlist/delete', Userlist::class, 'delete');
Router::post('/userlist/update', Userlist::class, 'update');
Router::post('/userlist/create', Userlist::class, 'create');



Router::enable();

