<?php

use core\router\Route;

return [
    'routes' => [
        new Route("", [
            "controller" => "main",
            "action" => "index"
        ]),
        new Route("todo/{x}",[
            "controller"=>"api",
            "action"=>"todo",
        ]),
        new Route("main/secure",[
            "controller" => "main",
            "action" => "secure",
        ],["secured"=>true,
            "role"=>"admin"]),
        new Route("main/login",[
            "controller" => "main",
            "action" => "login",
        ]),
        new Route("main/loginhandle",[
            "controller" => "main",
            "action" => "loginhandle",
        ]),
        new Route("main/logout",[
            "controller" => "main",
            "action" => "logout",
        ]),
        new Route("main/register",[
            "controller" => "main",
            "action" => "register",
        ]),
        new Route("main/registerhandle",[
            "controller" => "main",
            "action" => "registerhandle",
        ]),
    ]
];