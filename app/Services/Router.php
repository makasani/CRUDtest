<?php

namespace App\Services;


class Router
{
    
    private static $list = [];


    public static function page($uri, $page_name)
    {
        self::$list[] = [
            "uri" => $uri,
            "page" => $page_name
        ];

    }


    public static function get($uri, $class, $method)
    {
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "get" => true
        ];
    }


    public static function post($uri, $class, $method)
    {
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true
        ];
    }





    public static function enable()
    {
        $querry = $_GET['q'];
        
        foreach (self::$list as $route){
            if($route["uri"] === '/' . $querry) {
                if($route["post"] === true && $_SERVER["REQUEST_METHOD"] === "POST") {
                    $action = new $route["class"];
                    $method = $route["method"];
                    $action->$method($_POST);
                    die();
            } else {
                    require_once "views/pages/" . $route['page'] . ".php";
                    die();
                }
            }
        }
        self::error('404');
    }



    public  static function error($error)
    {
        require_once "views/errors/" . $error . ".php" ;
    }

    public  static function redirect($uri)
    {
        header('Location: ' . $uri);
    }

}