<?php
namespace App\Http\Core\Response\Adapter\PresentersModels;


class ResponseModel
{
    public function __construct(private $data, private string  $message ,private $status = 404, private string $viewPath=''){}

    function getData(){
        return $this->data;
    }

    function getMessage(){
        return $this->message;
    }

    function getStatus(){
        return $this->status;
    }
    public function getViewPath(){
        return $this->viewPath;
    }
}
