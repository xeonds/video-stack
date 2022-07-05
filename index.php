<?php

$site = array(
    'home' => 'static/index.html',
    'admin' => 'static/admin.html'
);
$config = json_decode(file_get_contents('config.json'), true);
// $router = json_decode(file_get_contents('router.json'), true);
$router = json_decode(`{
    "/": {
        "controller": "index",
        "arg":null
    },
    "list": {
        "controller": "index",
        "arg":"/"
    },
    "play": {
        "controller": "player",
        "arg":$1
    }
}`, true);

class Router {
    private $router_map;
    private $router_url;
    public $router_arg;

    public function load($rmap) {
        $this->router_map = $rmap;
        $this->router_url =  join("/", $_GET);
        var_dump($_GET);

        return $this;
    }

    public function route() {
        foreach ($this->router_map as $route_path => $route_config) {
            $route_path = explode('/', $route_path);
            if ($route_path == $this->router_url) {

                break;
            }
        }

        return $this;
    }
}

$router = new Router();
$router->load($router)
    ->route();
