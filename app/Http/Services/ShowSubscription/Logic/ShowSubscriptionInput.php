<?php
namespace App\Http\Services\ShowSubscription\Logic;

use App\Http\Core\InternalInterface\InputServiceInterface;

class ShowSubscriptionInput implements InputServiceInterface
{
    public function __construct( array $input)
    {}

    // write your input function here..

    public function toArray(){
        return [
            ''=>''
        ];
    }
}
