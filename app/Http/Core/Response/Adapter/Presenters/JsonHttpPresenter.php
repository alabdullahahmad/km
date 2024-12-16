<?php
namespace App\Http\Core\Response\Adapter\Presenters;

use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;

class JsonHttpPresenter {
    public static function sendSuccessJson(ResponseModel $data) {
        if (is_array($data->getData()) || is_object($data->getData())) {
            $count =count( $data->getData());
        }
        else
            $count = 0 ;
        return response()->json([
            'status' => 200,
            'message' => checkLangAndSendMessage($data->getMessage()),
            'data' => $data->getData(),
            'recordsTotal' => $count,
            'recordsFiltered' => $count
        ], 200);

    }

    public static function sendFiledJson(ResponseModel $data) {
        return response()->json([
            'status' => $data->getStatus(),
            'message' => checkLangAndSendMessage($data->getMessage()),
            'data' => $data->getData(),
        ], 500);
    }

}
