<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use View;
use DB;
use Hash;
use App\CustomFunction\CustomFunction;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\LogData;


class LogController extends Controller {

    public function __construct() {
    }

    public function getIndex() {

        $cuid = Auth::user()->master_admin;
        if($cuid == 1){
            $result = LogData::getall();
            return View::make('admin/log/index')->with('result', $result);
        }else{
            return Redirect::to('admin/dashboard');
        }

    }

}
