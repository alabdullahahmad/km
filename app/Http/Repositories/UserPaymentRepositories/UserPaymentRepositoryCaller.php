<?php
namespace App\Http\Repositories\UserPaymentRepositories;

class UserPaymentRepositoryCaller{

    static public function createRepository(){return (new UserPaymentCreateRepository());}
    static public function readRepository(){return (new UserPaymentReadRepository());}
    static public function updateRepository(){return (new UserPaymentUpdateRepository());}
    static public function deleteRepository(){return (new UserPaymentDeleteRepository());}

}