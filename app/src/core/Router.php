<?php

namespace App\Core {

    use App\Core\IController;
    use App\Controllers\FormController;
    use App\Controllers\NewsController;
    use App\Controllers\ErrorController;

    class Router {

        public function getController(): IController {

            /*
            **  Get controller path from url if exists
            */
            $controller = '';

            if(array_key_exists('url', $_GET)) {
                $controller = $_GET['url'];
            }

            /*
            **  Get url query if exists
            */
            $params = [];
            
            $parsedURL = parse_url($_SERVER['REQUEST_URI']);
            if(array_key_exists('query', $parsedURL)) {
                parse_str($parsedURL['query'], $params);
            }

            /*
            **  Check if controller's file exist
            **
            **  If exitsts return controller instance
            **  If no return error controller instance with status 404
            */
            if (file_exists("../app/controllers/$controller.controller.php")) {
                $controllerName = ucwords($controller) . "Controller";
                $controllerClassName = "App\\Controllers\\$controllerName";
                return new $controllerClassName($params);
            } else {
                return new ErrorController(['status' => 404]);
            }

        }

    }

}