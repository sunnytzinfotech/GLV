<?php

namespace App\Http\Controllers\admin\pages_content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Validator;
use Hash;
use Carbon\Carbon;
use Mail;
use Auth;
use File;
use Cart;
use URL;
use Input;
use Artisan;

class SoeinfachcontentController extends Controller
{

	public function index()
	{
        $data['content_data'] = array();

        $result = DB::table('site_data')->where('page_name','=','soeinfach')->get();
        if(!empty($result))
        {
            foreach($result as $key => $value){
                $data['content_data'][$value->action] = $value->description;
            }
        }
        return View::make('admin/page_content/soeinfach', $data);

	}



}
