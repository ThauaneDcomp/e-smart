<?php

class Controller{
    protected $server = 'http://localhost';
    protected $nameApp = 'smart_e-ping-2';

    public function model($model){
        require_once('../app/models/' . $model . '.php');
        return new $model();
    }
    
    public function view($view, $data = []){
        require_once('../app/view/' . $view . '.php');
    }

    public function component($component, $data = []){
        return require_once('../app/component/' . $component . '.php');
    }
}