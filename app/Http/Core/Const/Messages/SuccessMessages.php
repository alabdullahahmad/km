<?php
namespace App\Http\Core\Const\Messages;


class SuccessMessages{

    static public $AccountCreated = 'account_created';
    static public $logout = 'logout_success';
    static public $Add = 'add_success';
    static public $delete = 'delete_success';
    static public $show = 'show_success';
    static public $edit = 'edit_success';

    static function getKey(string $key , Attributes $attribute = Attributes::None){
        return $attribute->value.":messages." . $key;
    }


}
