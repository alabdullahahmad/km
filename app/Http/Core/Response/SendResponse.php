<?php
namespace App\Http\Core\Response;

use App\Http\Core\Response\Adapter\Presenters\JsonHttpPresenter;
use App\Http\Core\Response\Adapter\Presenters\ViewPresenter;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
class SendResponse
{
    function __construct() {}

    public static function sendSuccessResponse(ResponseModel $data) {
        if (request()->expectsJson()) {
            return (new JsonHttpPresenter())->sendSuccessJson($data);
        }
        return (new ViewPresenter())->sendSuccessView($data);
    }



    public static function sendFiledResponse(ResponseModel  $data) {
        if (request()->expectsJson()) {
            return (new JsonHttpPresenter())->sendFiledJson($data);
        }
       return (new ViewPresenter())->sendFiledView($data);
    }


}
