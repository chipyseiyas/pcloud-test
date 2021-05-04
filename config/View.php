<?php

class View
{

    const PATH_VIEW = __DIR__."/../view/";

    function __construct()
    {
    }
 
    public function show($name, $vars = array())
    {        
        $path = self::PATH_VIEW . $name;
 
        if (file_exists($path) == false)
        {
            throw new Exception("Not found template", 404);            
        }
 
        if(is_array($vars))
        {
            foreach ($vars as $key => $value)
            {
                ${$key} = $value;
            }
        }
        
        include($path);
    }

    function showContent($name, $vars = array())
    {
        $path = self::PATH_VIEW . $name;
 
        if (file_exists($path) == false)
        {
            throw new Exception("Not found template", 404);            
        }
 
        if(is_array($vars))
        {
            foreach ($vars as $key => $value)
            {
                ${$key} = $value;
            }
        }

        if (is_file($path))
        {
            ob_start();
            include $path;
            return ob_get_clean();
        }
        return false;
    }

}