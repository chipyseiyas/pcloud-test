<?php

require_once __DIR__.'/../config/ControllerAbstract.php';


final class DefaultController extends ControllerAbstract
{

    const URLINDEED = 'https://people-pro.com/xml-feed/indeed';

    public function index()
    {
        $this->view->show('header.php');

        $this->view->show('default/index.php',[]);

        $this->view->show('footer.php');        
    }

    public function parse($url) 
    {
        $fileContents= file_get_contents($url);

		$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);

		$fileContents = trim(str_replace('"', "'", $fileContents));

		$simpleXml = simplexml_load_string($fileContents,'SimpleXMLElement', LIBXML_NOCDATA);
        
        return $simpleXml;                          
    }      

    public function getResult()
    {
        $response = [];
        try
        {
            $sXML = $this->parse(self::URLINDEED);
            
            $response['success'] = true;

            $response['data'] = $sXML;

            $response['message'] = 'success';

            echo json_encode($response);
        }
        catch(Exception $e)
        {            
            $response['success'] = false;       

            $response['message'] = $e->getMessage();

            $response['data'] = $e->getMessage();

            echo json_encode($response);
        }
    }
}