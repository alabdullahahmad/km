<?php

namespace App\Http\Core\Response\Adapter\Presenters;

use App\Http\Core\Const\Options\ResponseCode;
use Exception;
use App\Http\Core\Response\Adapter\PresentersModels\ResponseModel;
use Illuminate\Support\Facades\Route;

class ViewPresenter
{
    public static function sendSuccessView(ResponseModel $data)
    {

        switch ($data->getStatus()) {
            case ResponseCode::Success->value:
                if (view()->exists($data->getViewPath())) {
                    return view($data->getViewPath())->with([
                        "data" => $data->getData(),
                        'message' => checkLangAndSendMessage($data->getMessage()),
                        'status' => 200,
                        'auth_user' => authSession()
                    ]);
                } else {
                    info($data->getViewPath());
                    throw new Exception('View not found', 404);
                }
                break;

            case ResponseCode::Redirect->value:
                if (Route::has($data->getViewPath())) {
                    return redirect()->route($data->getViewPath(),[
                        "data" => $data->getData(),
                        'message' => checkLangAndSendMessage($data->getMessage()),
                        'status' => 200,
                        // 'auth_user' =>  authSession()
                    ]);
                } else {
                    throw new Exception('Route not found', 404);
                }
                break;

                case ResponseCode::InValiedData->value:
                    return redirect()->back()->with([
                        "data" => $data->getData(),
                        'message' => checkLangAndSendMessage($data->getMessage()),
                        'status' => $data->getStatus(),
                        'auth_user' =>  authSession()
                    ]);
                break;

            default:
                throw new Exception('No match Status', 500);
                break;
        }
    }

    public static function sendFiledView(ResponseModel $data)
    {
        switch ($data->getStatus()) {
            case ResponseCode::InValiedData->value:
                return redirect()->back()->with([
                    "data" => $data->getData(),
                    'message' => checkLangAndSendMessage($data->getMessage()),
                    'status' => $data->getStatus(),
                    'auth_user' =>  authSession()
                ]);
                break;

            case ResponseCode::NotFound->value:
                return view('errors.404')->with([
                    "data" => $data->getData(),
                    'message' => checkLangAndSendMessage($data->getMessage()),
                    'status' => 404,
                    'auth_user' =>  authSession()
                ]);
                break;
            default:
                return view('errors.500')->with([
                "data" => $data->getData(),
                'message' => checkLangAndSendMessage($data->getMessage()),
                'status' => 200,
                ]);
                break;
        }
    }
}
