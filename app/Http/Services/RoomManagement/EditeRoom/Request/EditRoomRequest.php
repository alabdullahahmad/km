<?php
namespace App\Http\Services\RoomManagement\EditeRoom\Request;

use App\Http\Core\Request\BaseRequest;

class EditRoomRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
        [
            'roomId'=>['required' , 'integer' , 'exists:rooms,id'],
            'name' => ['required' , 'string'],
            'capacity' => ['required' , 'integer']
        ];
    }

}