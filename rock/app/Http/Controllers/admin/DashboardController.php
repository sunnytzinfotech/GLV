<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\User;

class DashboardController extends Controller {

    public function __construct() {

    }

    public function getIndex() {

        $useractive = User::where('admin_confirm',"=",1)->get();
        $useractive_count = count($useractive);
        $userdeactive = User::where('admin_confirm',"=",0)->get();
        $userdeactive_count = count($userdeactive);

        return view('admin.dashboard',compact('userdeactive_count','useractive_count'));
    }

}
