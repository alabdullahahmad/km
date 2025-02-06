<?php
namespace App\Http\Repositories\DailyLoginRepositories;
use App\Models\{DailyLogin};

class DailyLoginRepositoryCaller{

    static public function createRepository(){return (new DailyLoginCreateRepository());}
    static public function readRepository(){return (new DailyLoginReadRepository());}
    static public function updateRepository(){return (new DailyLoginUpdateRepository());}
    static public function deleteRepository(){return (new DailyLoginDeleteRepository());}
    static public function get_model() : DailyLogin {return (new DailyLogin());}


}