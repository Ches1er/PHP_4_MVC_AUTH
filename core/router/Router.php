<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 11.02.2019
 * Time: 19:14
 */
namespace core\router;
use http\Exception\RuntimeException;
use core\auth\Auth;

class Router
{
    private $routes = [];

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @throws RouterException
     */
    public function route(){
        foreach ($this->routes as $route){
            if($route->match()){
                $controller = $route->getControllerName();
                $action = $route->getActionName();
                $secured = $route->getSecured();
                $role = $route->getRole();

                //check secured routes
                if ($secured && Auth::instance()->hasRole($role)){
                    $this->navigate($controller,$action,$route);
                }
                else if ($secured && !Auth::instance()->hasRole($role)){
                    Auth::instance()->errorMessagetoSession("please sign in as admin!");
                    $this->navigate($controller,"index",$route);
                }

                else $this->navigate($controller,$action,$route);
                return;
            }
        }
        throw new RouterException();
    }

    /**
     * @param $controller
     * @param $action
     * @throws RouterException
     */
    private function navigate($controller, $action,$route)
    {
        $controller = ucfirst($controller);
        $action = "action".ucfirst($action);
        $controller_path = APP_DIR."controllers/$controller".EXT;
        if(!file_exists($controller_path)) throw new RouterException();
        $controller = "app\controllers\\$controller";
        $ctrl = new $controller();
        if(!method_exists($ctrl,$action)) throw new RouterException();
        $ctrl->setRoute($route);
        echo $ctrl->execAction($action);
    }


}