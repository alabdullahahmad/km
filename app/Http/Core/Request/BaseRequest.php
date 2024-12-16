<?php
namespace App\Http\Core\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Core\Const\Messages\ErrorMessages;

abstract class BaseRequest extends FormRequest
{
    // protected function failedValidation(Validator $validator)
    // {
    //     make_exception(ErrorMessages::getKey(ErrorMessages::$invalidData),422);
    // }
}
