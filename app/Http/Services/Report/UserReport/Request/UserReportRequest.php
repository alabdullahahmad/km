<?php
namespace App\Http\Services\Report\UserReport\Request;

use App\Http\Core\Request\BaseRequest;

class UserReportRequest extends BaseRequest
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
            'startDate' => ['nullable' , 'date_format:Y-m-d'],
            'endDate' => ['nullable' , 'date_format:Y-m-d'],
            'gender' => ['nullable' , 'string' , 'in:male,female,']
        ];
    }

}
