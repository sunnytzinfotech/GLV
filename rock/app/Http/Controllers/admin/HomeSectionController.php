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
use StdClass;
use Session;
use Image;
use URL;
use File;
use Mail;
use App\CustomFunction\CustomFunction;
use App\Models\User;
use App\Models\UserDetail;

class HomeSectionController extends Controller {

    public function __construct() {

    }

    public function userAllData(Request $request)
    {
    	$id = 0;
        $sessionData = Session::get('adminLog');
        $id = $sessionData['id'];
        if (isset($id) && ($id != 0)) {

            // $result = User::where('urole', "=" , 2)->paginate(15);
            $result = User::where('urole', "=" , 2)->get();
	    	return view('admin.user.index',compact('result'));

		}
		else{
			Session::flash('admin_operationFailed','Please Login!');
            return Redirect::to('admin/login');
		}
    }

    public function userEdit($ids)
    {

        $id = 0;
        $sessionData = Session::get('adminLog');
        $id = $sessionData['id'];
        if (isset($id) && ($id != 0)) {

            $user = User::where('id', "=" , $ids)->first();
            $userDetail = UserDetail::where('user_id', "=" , $ids)->first();
            // dd($userDetail,$user);
            return view('admin.user.edit',compact('user','userDetail'));

        }
        else{
            Session::flash('admin_operationFailed','Please Login!');
            return Redirect::to('admin/login');
        }
    }

    public function actionConfim(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('users')->where('id','=', $id)->update(["admin_confirm"=>1]);

            $user_data = User::where('id','=',$id)->first();

            if(isset($user_data) && !empty($user_data)){

                $user_id = $user_data->user_id;
                $userName = $user_data->user_name.' '.$user_data->last_name;
                $email = $user_data->email;

                $logo1 = asset('/assets/frontend/images/email_logo_1.png');
                $logo2 = asset('/assets/frontend/images/email_logo_2.png');

                $data = array('email' => $email,'logo1' => $logo1,'logo2'=>$logo2,'userName'=>$userName);

                try {
                    Mail::send('frontview.email_template_admin_confim', $data, function ($message) use ($email) {
                        $message->to($email)->subject('Bestätigungs-E-Mail / GLV-Tipp');
                    });
                    echo '0';
                } catch (Exception $exc) {

                }

            }

        }else{
            echo '1';
        }
    }
    public function actionConfimDeactive(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('users')->where('id','=', $id)->update(["admin_confirm"=>0]);

            // $user_data = User::where('id','=',$id)->first();

            // if(isset($user_data) && !empty($user_data)){

            //     $user_id = $user_data->user_id;
            //     $userName = $user_data->user_name.' '.$user_data->last_name;
            //     $email = $user_data->email;

            //     $logo1 = asset('/assets/frontend/images/email_logo_1.png');
            //     $logo2 = asset('/assets/frontend/images/email_logo_2.png');

            //     $data = array('email' => $email,'logo1' => $logo1,'logo2'=>$logo2,'userName'=>$userName);

            //     try {
            //         Mail::send('frontview.email_template_admin_deconfim', $data, function ($message) use ($email) {
            //             $message->to($email)->subject('De-active Account RockIt');
            //         });
            //     } catch (Exception $exc) {

            //     }

            // }

            echo '0';

        }else{
            echo '1';
        }
    }


    public function activeBorker(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('users')->where('id','=', $id)->update(["broker"=>"no"]);


            echo '0';

        }else{
            echo '1';
        }
    }
    public function deactiveBorker(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('users')->where('id','=', $id)->update(["broker"=>"yes"]);


            echo '0';

        }else{
            echo '1';
        }
    }

    public function deleteUser(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            DB::table('user_detail')->where('user_id','=', $id)->delete();;
            DB::table('users')->where('id','=', $id)->delete();;


            echo '0';

        }else{
            echo '1';
        }
    }

}
