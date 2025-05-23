<?php
    const REDIRECT_PREFIX = 'redirect:';
    function dispatch($routing, $action_url)
    {
        $controller_name = $routing[$action_url];
        $model = [];
        $view_name = $controller_name($model);
        build_response($view_name, $model);
    }
    function build_response($view, $model)
    {
        if (strpos($view, 'redirect:') === 0) {
            $url = substr($view, strlen('redirect:'));
            header("Location: " . $url);
            exit;
        } else {
            render($view, $model);
        }
    }
    function render($view_name, $model)
    {
        extract($model);
        if($view_name != 'ajax')
            include 'views/' . $view_name . '.php';
    }
?>