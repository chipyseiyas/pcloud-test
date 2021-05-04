<?php
require_once __DIR__.'/View.php';

class ControllerAbstract
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getParamsRequest($key = '')
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(!empty($key))
        {
            if(!isset($data[$key]))
            {
                throw new Exception("not found key $key", 400);                
            }
            return $data[$key];
        }
        return $data;
    }    
}
